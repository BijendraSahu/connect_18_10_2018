<div class="servey_question"><i class="mdi mdi-help-circle basic_icon_margin"></i>
    <span id="view_survey_question">{{$survey->question}}</span>
</div>
<div class="servey_ans">
    <div class="radio">
        <input id="radio-1" value="1" class="gender" name="servey_radio"
               type="radio" @if(isset($user_survey)) {{$user_survey->survey_ans == 1 ? 'checked=""':'' }} @endif >
        <label for="radio-1" class="radio-label">{{$survey->option1}}</label>
    </div>
    <div class="radio">
        <input id="radio-2" value="2" class="gender" name="servey_radio"
               type="radio" @if(isset($user_survey)) {{$user_survey->survey_ans == 2 ? 'checked=""':'' }} @endif>
        <label for="radio-2" class="radio-label">{{$survey->option2}}</label>
    </div>
    @if(isset($survey->option3))
        <div class="radio">
            <input id="radio-3" value="3" class="gender" name="servey_radio"
                   type="radio" @if(isset($user_survey)) {{$user_survey->survey_ans == 3 ? 'checked=""':'' }} @endif>
            <label for="radio-3" class="radio-label">{{$survey->option3}}</label>
        </div>
    @elseif(isset($survey->option4))
        <div class="radio">
            <input id="radio-4" value="4" class="gender" name="servey_radio"
                   type="radio" @if(isset($user_survey)) {{$user_survey->survey_ans == 4 ? 'checked=""':'' }} @endif>
            <label for="radio-4" class="radio-label">{{$survey->option4}}</label>
        </div>
    @endif

</div>
<input type="hidden" id="servey_id" value="{{$survey->id}}">