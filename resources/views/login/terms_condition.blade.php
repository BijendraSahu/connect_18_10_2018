<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Terms & Conditions</title>
    @include('login.plugin_header')
    <style type="text/css">
        .tab_container
        {
            width: 100%;
            display: inline-block;
            position: relative;
        }
        label {
            font-weight: 700;
            font-size: 14px;
            display: block;
            float: left;
            padding: 15px 15px;
            color: #757575;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            background: #f0f0f0;
        }
        .tab_container i {
            font-size: 18px;
            margin-right: 5px;
            color: #07d;
        }
        #tab1:checked ~ #content1, #tab2:checked ~ #content2, #tab3:checked ~ #content3, #tab4:checked ~ #content4, #tab5:checked ~ #content5 {
            display: block;
            background: #fff;
            color: #999;
        }
        .tab_container .tab-content p,
        .tab_container .tab-content h3,
        .tab_container .tab-content h5{
            -webkit-animation: fadeInScale 0.7s ease-in-out;
            -moz-animation: fadeInScale 0.7s ease-in-out;
            animation: fadeInScale 0.7s ease-in-out;
            margin-bottom: 5px;
        }
        .tab-content h5
        {
            font-weight: bold;
        }
        .tab_container [id^="tab"]:checked + label {
            background: #fff;
            box-shadow: inset 0 3px #07d;
        }

        .tab_container [id^="tab"]:checked + label .fa {
            color: #07d;
        }
        .clearfix:before,
        .clearfix:after {
            content: " ";
            display: table;
        }
        .clearfix:after {
            clear: both;
        }
        input, section {
            clear: both;
            padding-top: 10px;
            display: none;
        }
        .data_heading
        {
            font-size: 16px;
        }
        @keyframes fadeInScale {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg_profile_color">
@include('login.outer_master')
<div class="privacy_images">
    <div id="particles-js" class="canvas_block"></div>
    <script src="{{ asset('js/Social_Connectivity.js') }}"></script>
<div class="overlay_image">

</div>
<div class="main_heading">
    <h1>Terms & </h1>
    <h1>Conditions</h1>
</div>
</div>
<div class="container">
    <div class="basic_otherformbox">
        <div class="tab_container">
            <input id="tab1" type="radio" name="tabs" checked>
            <label for="tab1"><i class="mdi mdi mdi-checkbox-multiple-marked-outline"></i><span>Terms & Conditions</span></label>

            <input id="tab2" type="radio" name="tabs">
            <label for="tab2"><i class="mdi mdi-format-list-checks"></i><span>Payment Terms</span></label>
            <section id="content1" class="tab-content">
                <p>The terms &quot;We&quot; / &quot;Us&quot; / &quot;Our&quot;/”Company” individually and collectively refer to Connecting-One.com and the terms &quot;Visitor” ”User” refer to the users.</p>
                <p>This page states the Terms and Conditions under which you (Visitor) may visit this website (“Website”). Please read this page carefully. If you do not accept the Terms and Conditions stated here, we would request you to exit this site. The business, any of its business divisions and / or its subsidiaries, associate companies or subsidiaries to subsidiaries or such other investment companies (in India or abroad) reserve their respective rights to revise these Terms and Conditions at any time by updating this posting. You should visit this page periodically to re-appraise yourself of the Terms and Conditions, because they are binding on all users of this Website</p>
                <h3 class="data_heading">USE OF CONTENT</h3>
                <p>All logos, brands, marks headings, labels, names, signatures, numerals, shapes or any combinations thereof, appearing in this site, except as otherwise noted, are properties either owned, or used under licence, by the business and / or its associate entities who feature on this Website. The use of these properties or any other content on this site, except as provided in these terms and conditions or in the site content, is strictly prohibited.</p>
                <p>You may not sell or modify the content of this Website  or reproduce, display, publicly perform, distribute, or otherwise use the materials in any way for any public or commercial purpose without the respective organisation’s or entity’s written permission</p>
                <h3 class="data_heading" href="#Modal_payoptionlist" data-toggle="modal">ACCEPTABLE WEBSITE USE</h3>
                <h5>(A) Security Rules</h5>
                <p>
                    Visitors are prohibited from violating or attempting to violate the security of the Web site, including, without limitation, (1) accessing data not intended for such user or logging into a server or account which the user is not authorised to access, (2) attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorisation, (3) attempting to interfere with service to any user, host or network, including, without limitation, via means of submitting a virus or "Trojan horse" to the Website, overloading, "flooding", "mail bombing" or "crashing", or (4) sending unsolicited electronic mail, including promotions and/or advertising of products or services. Violations of system or network security may result in civil or criminal liability. The business and / or its associate entities will have the right to investigate occurrences that they suspect as involving such violations and will have the right to involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations.
                </p>
                <h5>(B) General Rules</h5>
                <p>Visitors may not use the Web Site in order to transmit, distribute, store or destroy material (a) that could constitute or encourage conduct that would be considered a criminal offence or violate any applicable law or regulation, (b) in a manner that will infringe the copyright, trademark, trade secret or other intellectual property rights of others or violate the privacy or publicity of other personal rights of others, or (c) that is libellous, defamatory, pornographic, profane, obscene, threatening, abusive or hateful.</p>
                <h3  class="data_heading" >INDEMNITY</h3>
                <p>The User unilaterally agree to indemnify and hold harmless, without objection, the Company, its officers, directors, employees and agents from and against any claims, actions and/or demands and/or liabilities and/or losses and/or damages whatsoever arising from or resulting from their use of www.connecting-one.com or their breach of the terms . </p>
                <h3 class="data_heading">LIABILITY</h3>
                <p>User agrees that neither Company nor its group companies, directors, officers or employee shall be liable for any direct or/and indirect or/and incidental or/and special or/and consequential or/and exemplary damages, resulting from the use or/and the inability to use the service or/and for cost of procurement of substitute goods or/and services or resulting from any goods or/and data or/and information or/and services purchased or/and obtained or/and messages received or/and transactions entered into through or/and from the service or/and resulting from unauthorized access to or/and alteration of user's transmissions or/and data or/and arising from any other matter relating to the service, including but not limited to, damages for loss of profits or/and use or/and data or other intangible, even if Company has been advised of the possibility of such damages.</p>
                <p>User further agrees that Company shall not be liable for any damages arising from interruption, suspension or termination of service, including but not limited to direct or/and indirect or/and incidental or/and special consequential or/and exemplary damages, whether such interruption or/and suspension or/and termination was justified or not, negligent or intentional, inadvertent or advertent. </p>
                <p>User agrees that Company shall not be responsible or liable to user, or anyone, for the statements or conduct of any third party of the service. In sum, in no event shall Company's total liability to the User for all damages or/and losses or/and causes of action exceed the amount paid by the User to Company, if any, that is related to the cause of action.</p>
                <p>If any member if found guilty/culprit/ or done wrong, its membership will be cancelled.</p>
                <h3 class="data_heading">DISCLAIMER OF CONSEQUENTIAL DAMAGES</h3>
                <p>In no event shall Company or any parties, organizations or entities associated with the corporate brand name us or otherwise, mentioned at this Website be liable for any damages whatsoever (including, without limitations, incidental and consequential damages, lost profits, or damage to computer hardware or loss of data information or business interruption) resulting from the use or inability to use the Website and the Website material, whether based on warranty, contract, tort, or any other legal theory, and whether or not, such organization or entities were advised of the possibility of such damages.</p>
                <h3 class="data_heading">Applicable Law and Jurisdiction </h3>
                <p>By visiting this Portal, you agree that the laws of the Republic of India (state of Madhya Pradesh, City Jabalpur)  without regard to its conflict of laws principles, govern this Privacy Policy and any dispute arising in respect hereof shall be subject to and governed by the dispute resolution process set out in the Terms and Conditions. You and Connecting-One.com agree to submit to the personal and exclusive jurisdiction of the court located within Jabalpur, Madhya Pradesh.</p>
                <p>Our failure / server error or any force majeure or Enforce any right or provision of this agreement shall not constitute a waiver of such rights or provision unless acknowledge and agreed </p>
            </section>
            <section id="content2" class="tab-content">
                <h3  class="data_heading">MAKING PAYMENTS</h3>
                <p>1.	Funding and spending. When you make a payment on Connecting-One you agree to provide a valid funding instrument. When you have successfully added your funding instrument, we will allow you to initiate a transaction using Connecting-One Payments (“Connecting-One Payments”).</p>
                <p>2.	Pricing. Pay attention to the details of the transaction, because your total price may include taxes, fees, and shipping costs, all of which you are responsible for paying.</p>
                <p>3.	Sponsored posts. Posts you have Sponsored are subject to our Advertising Guidelines.</p>
                <p> Indian residents: To opt out of P2P, please send written notice of your choice to: Connecting-One Enterprises,Address: Ho no- 475, BuddhuKachiKaBada, Ranjhi, Jabalpur – MP , PIN -482001.Note that opting out of P2P may affect your ability to make other transactions using Connecting-One Payments.</p>
                <p> No Warranties. You acknowledge that any products or services you may purchase are sold by merchants, not by Connecting-One Enterprises. WE MAKE NO WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, WITH RESPECT TO ANY PRODUCTS OR SERVICES SOLD ON OR THROUGH CONNECTING-ONE ENTERPRISES..</p>
                <h3 class="data_heading">PAYMENT METHODS</h3>
                <p>1.	Funding instruments. We want to make Connecting-One Payments convenient, so we allow you to fund your transactions using a number of different sources, like credit cards and debit cards, Connecting-One Gift Cards, and other payment methods.</p>
                <p>2.	Authority. When you provide a funding instrument to us, you confirm that you are permitted to use that funding instrument. When you fund a transaction, you authorize us (and our designated payment processor) to charge the full amount to the funding instrument you designate for the transaction. You also authorize us to collect and store that funding instrument, along with other related transaction information.</p>
                <p>3.	Authorization. If you pay by credit or debit card, we may obtain a pre-approval from the issuer of the card for an amount, which may be as high as the full price of your payment. Your card will be charged at the time you initiate a payment, or shortly thereafter. If you cancel a transaction before completion, this pre-approval may result in those funds not otherwise being immediately available to you.</p>
                <p>4.	Failed payments. If you pay by debit card and your load transaction results in an overdraft or other fee from your bank, you alone are responsible for that fee.</p>
                <p>5.	Incompatibility. You may at some point encounter an app or feature that does not support the payment method you would prefer to use; however, you can select a different type of payment instrument (such as credit or debit card, or mobile operator billing).</p>
                <p>6.	Mobile billing. Mobile operator billing is another payment method we have made available for your convenience. If you use mobile billing as a funding instrument, you consent to the following applicable risks and other terms:</p>
                <p>A. By choosing the mobile billing payment method, you agree that we and your mobile operator may exchange information about you in order to facilitate completion or reversal of payments, resolution of disputes, provision of customer support, or other billing-related activity.</p>
                <p>B. You are responsible for any charges, fees, changes to your mobile plan service or billing, alterations to your mobile device, or any other consequence that may arise out of your use of mobile billing.</p>
                <p>C. If you use mobile billing, you are bound not only by these Terms, but also by the terms and conditions of your mobile operator.
                </p>
                <p>D. If you have questions about any charges or fees that appear on your mobile phone bill, you may contact your mobile provider’s customer service division.</p>
                <p>E. Sometimes, use of mobile billing may lead to charges that, for various technical reasons beyond our control, cannot be refunded to you. In these cases, we have the right, but not the obligation, to issue you a courtesy credit.</p>
                <p>7.	Paytm (Pre-paid). If you use Paytm as a payment method, you consent to the following applicable risks and other terms:</p>
                <p>A. Refunds. Due to technical limitations, we are able to provide refunds ONLY by making cash deposit into a bank account. If you make a purchase with Paytm and later request a refund for any reason, you MUST have a bank account in order to receive the refund. Additionally, the name on the bank account receiving the refund deposit MUST match the name on the Paytm used to make the payment.</p>
                <p>B. Safety. We may delay or limit the availability of your purchase, for either safety reasons, or to make sure we possess all relevant information necessary to process the payment and deliver to you what you have paid for.</p>
                <p>C. Information. You agree and consent that we will store your tax id (PAN/GST). We may use your tax id to obtain additional information about you, necessary to process the payment, from the federal tax id registration database provided by the Indian government, via a third-party processor. We will also submit final tax documents to the Indian government as required.</p>
                <h3 class="data_heading">ACTIONS WE MAY TAKE</h3>
                <p>1.	At-will use. We may revoke your eligibility to use Connecting-One Payments at any time at our sole discretion.</p>
                <p>2.	Inquiries. By usingConnecting-One Payments, you acknowledge and agree that we may make any inquiries that we consider necessary, either directly or through third parties, concerning your identity and creditworthiness.</p>
                <p>3.	Our right to cancel. We may cancel any transaction if we believe the transaction violates these Terms or the Statement of Rights and Responsibilities, or if we believe doing so may prevent financial loss. We may also cancel any Gift Card Balance or Advertiser Balance accumulated, transferred, assigned, or sold as a result of fraudulent or illegal behavior.</p>
                <p>4.	Payment limitations. In order to prevent financial loss to you or to us, we may place a delay on a payment for a period of time, or limit funding instruments for a transaction, or limit your ability to make a payment, or deactivate your account.</p>
                <p>5.	Sharing of information. In order to prevent financial loss to you or to us, we may contact your funding instrument issuer, law enforcement, or affected third parties (including other users) and share details of any payments you are associated with, if we believe doing so may prevent financial loss or a violation of law.</p>
                <p>6.	Abandoned Property. If you leave a Gift Card Balance or Advertiser Balance unused for the period of time set forth by your state, country, or other governing body in its unclaimed property laws, or if you delete your account and leave a Gift Card Balance or Advertiser Balance, or if we deactivate your account and you do not meet any conditions necessary to reinstate it within six (6) months, we may process your Gift Card Balance or Advertiser Balance in accordance with our legal obligations, including by submitting funds associated with your Gift Card Balance or Advertiser Balance to the appropriate governing body as required by law.</p>
                <h3 class="data_heading">DISPUTES AND REVERSALS</h3>
                <p>1.	Customer assistance. We provide various tools in our Connecting-OnePayments capabilities to assist you in communicating with a third party to resolve a dispute arising from a payment transaction.</p>
                <p>2.	No liability for underlying transaction. If you enter into a transaction with a third party and have a dispute over the goods or services you purchased or over the donation you made, we have no liability for the goods or services underlying the transaction or for how the third party used your donation. Our only responsibility is to handle your payment transaction. All payments are final unless otherwise required by law. If you order something that becomes unavailable before it can be provided to you, you may request a refund of your payment.</p>
                <p>3.	Duty to notify us. If you believe that an unauthorized or otherwise problematic transaction has taken place under your account, you agree to notify us immediately, so that we may take action to prevent financial loss. Unless you submit the claim to us within 30 days after the charge, you will have waived, to the fullest extent permitted by law, all claims against us arising out of or otherwise related to the transaction.</p>
                <p>4.	Intervention. We may intervene in disputes concerning payments that may arise between you and a developer, but we have no obligation to do so.</p>
                <p>5.	Technical difficulties. If you experience a technical failure or interruption of service that causes your payment to fail, you may request that your transaction be completed at a later time.</p>
                <h3 class="data_heading">SPECIAL PROVISIONS APPLICABLE TO ADVERTISERS</h3>
                <p>1.	Agreement to pay. When you purchase advertising or promoted posts on or through Connecting-One, you agree to pay all amounts specified in the order, along with any applicable taxes under Indian Laws.</p>
                <p>2.	Consent to credit check. Your order constitutes your written authorization for us to obtain your personal and/or business credit report from a credit bureau. We may obtain your credit report when you place an order, or at any time thereafter.</p>
                <p>3.	Security. You are responsible for maintaining the security of your advertising account, and you understand that you will be charged for any orders placed on or through your advertising account.</p>
                <p>4.	Direct debit. If you are making direct debit payments, you agree that we can charge you any amount that falls within the range you agreed to upon signup. We will notify you in advance if any charge will exceed the agreed-upon range. If you want to change your preferred payment method from direct debit, you can do so from within your Connecting-One Payment Settings.</p>
                <p>5.	Cancellation. You can cancel an advertising order at any time through our online portal, but your ads may run for several days after you notify us, and you are still responsible for paying for those ads.</p>
                <p>6.	Tax liability. The amounts charged to you by us, whether through your credit card or otherwise, may be subject to and include applicable taxes, including without limitation withholding taxes. It is your responsibility to remit any taxes that apply to your transactions. You agree to indemnify and hold us harmless from and against any claim arising out of your failure to do so.</p>
                <p>7.	Delinquent accounts. If you purchase advertising, and your payment method fails or your account is past due, we may take steps to collect past due amounts using other collection mechanisms. You agree to pay all expenses associated with such collection, including reasonable attorneys' fees. Interest will accrue on any past due amounts at the rate of the lesser of 1% per month or the lawful maximum.</p>
                <p>8.	Advertiser Balance. You may have the option to purchase ads with an Advertiser Balance. An “Advertiser Balance” is a pre-paid balance that can be used solely to purchase advertisements on Connecting-One. You agree that Advertiser Balances are established solely for business or commercial purposes. Advertiser Balances are non-refundable except where required by law. Connecting-One is not a bank and does not offer banking services; accordingly, Advertiser Balances do not earn interest, are not deposit obligations, and are not insured by the Federal Deposit Insurance Corporation, the Financial Services Compensation Scheme, or any other entity or insurance scheme, whether governmental or private.</p>
                <p>9.	Invoiced and non-invoiced clients. When you purchase advertising or paid content on or through Connecting-One's self-serve advertising interfaces or APIs, you will fall under one of two categories depending on your payment method: invoiced or non-invoiced client. Invoiced clients are those to whom Connecting-One extends a credit line and issues invoices on a periodic basis for payment. Non-invoiced clients are those who make payments at the time of purchase itself. Clients are eligible to become invoiced clients based on factors such as ad spend and creditworthiness. Connecting-One retains the final right to classify a client as an invoiced client.</p>
                <h3 class="data_heading">NOTICES AND AMENDMENTS TO THESE TERMS</h3>
                <p>1.	Notice to you. By using the Connecting-One Payments service, you agree that we may communicate with you electronically any important information regarding your payments or your account. We may also provide notices to you by posting them on our website, or by sending them to an email address or street address that you previously provided to us. Website and email notices shall be considered received by you within 24 hours of the time posted or sent; notices by postal mail shall be considered received within three (3) business days of the time sent.</p>
                <p>2.	Notice to us. Except as otherwise stated, you must send notices to us relating to Connecting-One Payments and these Terms by postal mail to: Connecting-One  Enterprises , Ho no- 475, BuddhuKachiKaBada, Ranjhi, Jabalpur – MP , PIN -482001</p>
                <p>3.	Amendment guidelines. We may update these Payments Terms at any time without notice as we deem necessary to the full extent permitted by law. The Payments Terms in place at the time you confirm a transaction will govern that transaction.</p>
                <h3 class="data_heading">CUSTOMER COMPLAINTS</h3>
                <p>1.	India users: All jurisdiction cases to be hear under the Jabalpur court, Madhya Pradesh,India.</p>
                <h3 class="data_heading">ADDITIONAL TERMS</h3>
                <h5>1.	Conflict of terms.</h5>
                <p>1. To the extent you are a Connecting-One User, all of the commitments you make in the Connecting-One Statement of Rights and Responsibilities apply to your use of Connecting-One Payments. In the event of any conflict between these Terms and the Connecting-One Statement of Rights and Responsibilities, the Community Payments Terms shall prevail.</p>
                <p>2.	Courtesy translations. These Terms were written in English (US). To the extent any translated version of these terms conflicts with the English version, the English version controls.</p>
                <p>3.	“Us”. The following are the entities to which “us,” “we,” “our,” or “Connecting-One” refer: </p>
                <p>1. If you are a resident of or have your principal place of business in India, these Payments Terms are between you and Connecting-One Payments an Indian Enterprises. </p>
                <p>A.	To view Connecting-One Payments’ Privacy Policy, please visit https://www.connecting-one.com.</p>
                <p>B.	Connecting-One Payments. Licensed as a transmitter of money in various jurisdictions in India. To view Connecting-One Payments Money Transmitter Licenses, please visit https://www.connecting-one.com.</p>
            </section>
        </div>
    </div>
</div>
</body>
</html>