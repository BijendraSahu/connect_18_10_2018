(function($, undefined) {
	'use strict';
	$.fn.yahooWeather = function(p1) {
		const fahrenheitToCelsius = (f) => Math.ceil((f-32)/1.8);
		const kharkivLocation = {
			coords : {
				latitude : 50.0346748,
				longitude : 36.345833
			}
		}
		const config = {
			method : 'GET',
			mode : 'cors'
		}
		const def = {}
		const location = new Promise(function(res,rej){
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(res, rej);
			} else rej('Browser doesn\'t support Geolocation');
		});
		location
			.catch(()=> Promise.resolve(kharkivLocation))
			.then((location)=>{
				const query = `
					select * from weather.forecast where woeid in (
						SELECT woeid FROM geo.places 
						WHERE text="(${location.coords.latitude},${location.coords.longitude})"
					)
				`;  
				const uri = `https://query.yahooapis.com/v1/public/yql?q=${query}&format=json`;
				return fetch(uri, config)
			})
			.then(res => res.json())
			.then(res => {
				const item = res.query.results.channel.item;
				def.city = res.query.results.channel.location.city;
				def.country = res.query.results.channel.location.country;
				def.date = new Date(res.query.created);
				def.tHigh = fahrenheitToCelsius(item.forecast[0].high);
				def.tLow = fahrenheitToCelsius(item.forecast[0].low);
				def.condition = item.condition.code;
				def.temp = fahrenheitToCelsius(item.condition.temp);
				def.template = template;
				this.append(def.template());
			})
			.catch((err)=>{console.log(err)});
		return this;

		function template() {
			return `
				<div class="icon sun-shower">
                 <div class="cloud"></div>
                 <div class="sun">
                     <div class="rays"></div>
                 </div>
                 <div class="rain"></div>
                 <div class="lightning">
                     <div class="bolt"></div>
                     <div class="bolt"></div>
                 </div>
             </div>
             <div class="weat_temp">${this.temp}&deg;C</div>
             <div class="weat_location">${this.city}, ${this.country}</div>
			`;
		};
	}
})(jQuery)