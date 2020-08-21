@extends('shop::layouts.static_master')

@php
    $channel = core()->getCurrentChannel();

    $homeSEO = $channel->home_seo;

    if (isset($homeSEO)) {
        $homeSEO = json_decode($channel->home_seo);

        $metaTitle = $homeSEO->meta_title;

        $metaDescription = $homeSEO->meta_description;

        $metaKeywords = $homeSEO->meta_keywords;
    }
@endphp

@section('page_title')
    {{ isset($metaTitle) ? $metaTitle : "" }}
@endsection

@section('head')

    @if (isset($homeSEO))
        @isset($metaTitle)
            <meta name="title" content="{{ $metaTitle }}" />
        @endisset

        @isset($metaDescription)
            <meta name="description" content="{{ $metaDescription }}" />
        @endisset

        @isset($metaKeywords)
            <meta name="keywords" content="{{ $metaKeywords }}" />
        @endisset
    @endif
@endsection

@section('content-wrapper')
<div class="container mar_top_about">
    <div class="row crumbs">
    <div class="col-md-11" style="font-size: 1.5rem;margin-top: 20px;margin-bottom: 20px;">
        <a href="{{route('shop.home.index')}}" style="color:#0f3bb7;">Home</a> <i class="fa fa-chevron-right"></i> {{$menu}}
    </div>
    @include('shop::layouts.menu_nav')
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="/themes/velocity/assets/images/static/16.png" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <p class="htt">
        Privacy and Confidentiality
        <br>
        <br>
      </p>
      <p class="ts" style="font-size: 1.25rem">
        SafeShop
respects the privacy of our users. This Privacy Policy explains how we collect,
use, disclose, and safeguard your information when you visit our website SafeShop.com.bd
and our mobile application including any other media form, media channel,
mobile website, or mobile application related or connected thereto
(collectively, the “Site”). Please read this privacy policy carefully. If you
do not agree with the terms of this privacy policy, please do not access the
site.&nbsp; &nbsp; &nbsp;<br>We
reserve the right to make changes to this Privacy Policy at any time and for
any reason. We will alert you about any changes by updating the “Last Updated”
date of this Privacy Policy. Any changes or modifications will be effective
immediately upon posting the updated Privacy Policy on the Site, and you waive
the right to receive specific notice of each such change or modification.&nbsp; &nbsp; &nbsp;<br>are
encouraged to periodically review this Privacy Policy to stay informed of
updates. You will be deemed to have been made aware of, will be subject to, and
will be deemed to have accepted the changes in any revised Privacy Policy by
your continued use of the Site after the date such revised Privacy Policy is
posted.&nbsp; &nbsp; &nbsp;<br>
          <br><b>1.0 COLLECTION OF YOUR INFORMATION&nbsp;</b>
          <br>We may
collect information about you in a variety of ways. The information we may
collect on the Site includes:&nbsp; &nbsp;&nbsp;<br><b>1.1 Personal Data&nbsp;</b>
          <br>Personally identifiable information, such as your name,
shipping address, email address, and telephone number, and demographic
information, such as your age, gender, hometown, and interests, that you
voluntarily give to us [when you register with the Site or our mobile
application or when you choose to participate in various activities related to
the Site and our mobile application such as online chat and message boards. You
are under no obligation to provide us with personal information of any kind,
however your refusal to do so may prevent you from using certain features of
the Site and our mobile application.&nbsp; &nbsp;&nbsp;<br>
          <br><b>1.2 Derivative Data</b>&nbsp;<br>Information our servers automatically collect when you access
the Site, such as your IP address, your browser type, your operating system,
your access times, and the pages you have viewed directly before and after
accessing the Site. If you are using our mobile application, this information
may also include your device name and type, your operating system, your phone
number, your country, your likes and replies to a post, and other interactions
with the application and other users via server log files, as well as any other
information you choose to provide.&nbsp; &nbsp;&nbsp;<br>
          <br><b>1.3 Financial Data&nbsp;</b>
          <br>Financial
information, such as data related to your payment method (e.g. valid credit
card number, card brand, expiration date) that we may collect when you
purchase, order, return, exchange, or request information about our services
from the Site or our mobile application. We store only very limited, if any,
financial information that we collect. Otherwise, all financial information is
stored by our payment processor (please check our payment service provider
company) and you are encouraged to review their privacy policy and contact them
directly for responses to your questions.
&nbsp;
Facebook
Permissions&nbsp; 
The Site and our mobile application may by default access
your Facebook basic account information, including your name, email, gender,
birthday, current city, and profile picture URL, as well as other information
that you choose to make public. We may also request access to other permissions
related to your account, such as friends, checkins, and likes, and you may
choose to grant or deny us access to each individual permission. For more
information regarding Facebook permissions, refer to the <a href="https://developers.facebook.com/docs/facebook-login/permissions">Facebook
Permissions Reference </a>page.&nbsp; &nbsp;&nbsp;<br>
          <br><b>1.4 Data From Social
Networks&nbsp;</b>
          <br>User information from social networking sites, such as Facebook,
Google+, Instagram etc. &nbsp;including your
name, your social network username, location, gender, birth date, email
address, profile picture, and public data for contacts, if you connect your account
to such social networks. If you are using our mobile application, this
information may also include the contact information of anyone you invite to
use and join our mobile application.&nbsp; &nbsp;&nbsp;<br>
          <br><b>1.5 Mobile Device
Data&nbsp;</b>
          <br>Device information, such as your
mobile device ID, model, and manufacturer, and information about the location
of your device, if you access the Site from a mobile device.&nbsp; &nbsp;&nbsp;<br>
          <br><b>1.6 Third-Party Data</b>&nbsp;<br>Information from third parties, such as personal information
or network friends, if you connect your account to the third party and grant
the Site permission to access this information. Once you leave our store’s
website or are redirected to a third-party website or application, you are no
longer governed by this Privacy Policy or our website’s Terms of Service.&nbsp; &nbsp; &nbsp;<br>
          <br><b>1.7 Data From
Contests, Giveaways, and Surveys&nbsp;</b>
          <br>Personal and other
information you may provide when entering contests or giveaways and/or
responding to surveys.&nbsp; &nbsp;&nbsp;<br>
          <br><b>1.8 Mobile
Application Information&nbsp;</b>
          <br>If you connect using our mobile application:&nbsp; &nbsp;&nbsp;<!--[if !supportLists]-->
          <br>
          <br>●<i>Geo-Location
Information.</i><b></b>We may request access or permission to and track
location-based information from your mobile device, either continuously or
while you are using our mobile application, to provide location-based services.
If you wish to change our access or permissions, you may do so in your device’s
settings.&nbsp;<br>●&nbsp;<i>Mobile Device
Access.</i><b></b>We may request
access or permission to certain features from your mobile device, including
your mobile device’s Bluetooth, calendar, camera, contacts, microphone,
reminders, sensors, SMS messages, social media accounts, storage and other
features. If you wish to
change our access or permissions, you may do so in your device’s settings.<br>●<i>Mobile Device
Data.</i><b></b>We may collect device information (such as your mobile
device ID, model and manufacturer), operating system, version information and
IP address.&nbsp;<br>&nbsp;<!--[endif]-->●&nbsp;<i>Push
Notifications. </i>We may request to send you push notifications regarding your
account or the Application. If you wish to opt-out from receiving these types
of communications, you may turn them off in your device’s settings. <b>&nbsp;</b>
          <br>
          <br><b>2.0 USE OF YOUR
INFORMATION&nbsp;</b>
          <br>Having accurate information about you permits us to provide
you with a smooth, efficient, and customized experience. Specifically, we may
use information collected about you via the Site or our mobile application to:&nbsp; &nbsp;&nbsp;<br>● Administer sweepstakes, promotions, and contests.&nbsp;<br>● Assist law enforcement and respond to subpoena.&nbsp;<br>● Compile anonymous statistical data and analysis for use
internally or with third parties.&nbsp;<br>●&nbsp;Create and manage your account.&nbsp;<br>●Deliver targeted advertising, coupons, newsletters, and other
information regarding promotions and the Site and our mobile application to
you.&nbsp;<br>●&nbsp;&nbsp;Email you regarding your account or order.&nbsp;<br>●&nbsp;&nbsp;Enable user-to-user communications.&nbsp;<br>●&nbsp;&nbsp;Fulfill and manage purchases, orders, payments, and other transactions
related to the Site and our mobile application.&nbsp;<br>●&nbsp;&nbsp;Generate a personal profile about you to make future visits
to the Site and our mobile application more personalized.&nbsp;<br>●&nbsp;&nbsp;Increase the efficiency and operation of the Site and our
mobile application.&nbsp;<br>●&nbsp;&nbsp;Monitor and analyze usage and trends to improve your
experience with the Site and our mobile application.&nbsp;<br>●&nbsp;&nbsp;Notify you of updates to the Site and our mobile applications.&nbsp;<br>● Offer new products, services, mobile applications, and/or
recommendations to you.&nbsp;<br>●&nbsp;&nbsp;Perform other business activities as needed.&nbsp;<br>●&nbsp;Prevent fraudulent transactions, monitor against theft, and
protect against criminal activity.&nbsp;<br>●&nbsp;Process payments and refunds.&nbsp;<br>●&nbsp;&nbsp;Request feedback and contact you about your use of the Site
and our mobile application.&nbsp;<br>●&nbsp;&nbsp;Resolve disputes and troubleshoot problems.&nbsp;<br>●&nbsp;&nbsp;Respond to product and customer service requests.&nbsp;<br>●&nbsp;&nbsp;Send you a newsletter.&nbsp;<br>●&nbsp;&nbsp;Solicit support for the Site and our mobile application.&nbsp;<br>●&nbsp;&nbsp;Other <b>&nbsp;</b>&nbsp;<br>
          <br><b>3.0 DISCLOSURE
OF YOUR INFORMATION</b>
          <br>&nbsp;We may share information we have collected about you in
certain situations. Your information may be disclosed as follows:&nbsp; <b>&nbsp;</b>
          <br>&nbsp;<br><b>3.1 By Law or to
Protect Rights&nbsp;<br></b>If we believe the release of information about you is
necessary to respond to legal process, to investigate or remedy potential
violations of our policies, or to protect the rights, property, and safety of
others, we may share your information as permitted or required by any
applicable law, rule, or regulation. This includes exchanging information with
other entities for fraud protection and credit risk reduction.&nbsp; &nbsp;<br><b>3.2 Third-Party
Service Providers&nbsp;<br></b>We may share your information with third parties that perform
services for us or on our behalf, including payment processing, data analysis,
email delivery, hosting services, customer service, and marketing
assistance.&nbsp; &nbsp; &nbsp;&nbsp;<br>
          <br><b>3.3 Marketing
Communications&nbsp;<br></b>With your consent, or with an opportunity for you to withdraw
consent, we may share your information with third parties for marketing
purposes, as permitted by law.<br>&nbsp; &nbsp;&nbsp;<br><b>3.4 Interactions with Other
Users&nbsp;<br></b>If you interact with other
users of the Site and our mobile application, those users may see your name,
profile photo, and descriptions of your activity, including sending invitations
to other users, chatting with other users, liking posts, following blogs. 
&nbsp;
Online Postings
When you post comments, contributions or other content to the
Site [or our mobile applications, your posts may be viewed by all users and may
be publicly distributed outside the Site [and our mobile application in
perpetuity. 
&nbsp;
&nbsp;
Third-Party
Advertisers 
We may use third-party advertising companies to serve ads
when you visit the Site or our mobile application. These companies may use
information about your visits to the Site and our mobile application and other
websites that are contained in web cookies in order to provide advertisements
about goods and services of interest to you.&nbsp; &nbsp; &nbsp;<br>
          <br><b>3.5 Affiliates&nbsp;</b>
          <br>We may share your information with our affiliates, in which
case we will require those affiliates to honor this Privacy Policy. Affiliates
include our parent company and any subsidiaries, joint venture partners or other
companies that we control or that are under common control with us. <b>&nbsp;</b>&nbsp;<br>
          <br><b>3.6 Business Partners&nbsp;<br></b>We may share your
information with our business partners to offer you certain products, services
or promotions.&nbsp; &nbsp; &nbsp;<br>
          <br><b>3.7 Offer Wall&nbsp;&nbsp;</b>
          <br>Our mobile application may
display a third-party hosted “offer wall.” Such an offer wall allows
third-party advertisers to offer virtual currency, gifts, or other items to
users in return for acceptance and completion of an advertisement offer. Such
an offer wall may appear in our mobile application and be displayed to you
based on certain data, such as your geographic area or demographic information.
When you click on an offer wall, you will leave our mobile application. A
unique identifier, such as your user ID, will be shared with the offer wall
provider in order to prevent fraud and properly credit your account. <b>&nbsp;&nbsp;</b><b>&nbsp;</b>&nbsp;<br>
          <br><b>3.8 Social Media
Contacts&nbsp;</b>&nbsp;<br>If you connect to the Site
or our mobile application through a social network, your contacts on the social
network will see your name, profile photo, and descriptions of your activity.
&nbsp;
Other Third
Parties
We may share your information with advertisers and investors
for the purpose of conducting general business analysis. We may also share your
information with such third parties for marketing purposes, as permitted by
law. 
&nbsp;
We are not responsible for the actions of third parties with
whom you share personal or sensitive data, and we have no authority to manage
or control third-party solicitations. If you no longer wish to receive
correspondence, emails or other communications from third parties, you are responsible
for contacting the third party directly.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<br>
          <br><b>4.0 TRACKING
TECHNOLOGIES&nbsp;<br></b><b>4.1 Cookies
and Web Beacons&nbsp;</b>
          <br>We may use cookies, web beacons, tracking
pixels, and other tracking technologies on the Site and our mobile application
to help customize the Site and our mobile application and improve your experience.
When you access the Site or our mobile application, your personal information
is not collected through the use of tracking technology. Most browsers are set
to accept cookies by default. You can remove or reject cookies, but be aware
that such action could affect the availability and functionality of the Site or
our mobile application. You may not decline web beacons. However, they can be
rendered ineffective by declining all cookies or by modifying your web browser’s
settings to notify you each time a cookie is tendered, permitting you to accept
or decline cookies on an individual basis.
&nbsp;
We may use cookies, web beacons, tracking
pixels, and other tracking technologies on the Site and our mobile application
to help customize the Site [and our mobile application and improve your
experience. For more information on how we use cookies, please refer to our
Cookie Policy posted on the Site, which is incorporated into this Privacy
Policy. By using the Site, you agree to be bound by our Cookie Policy.&nbsp; &nbsp;&nbsp;<br>
          <br><b>4.2 Internet-Based
Advertising&nbsp;<br></b>Additionally, we may use third-party software
to serve ads on the Site and our mobile application, implement email marketing
campaigns, and manage other interactive marketing initiatives. This third-party
software may use cookies or similar tracking technology to help manage and
optimize your online experience with us. For more information about opting-out
of interest-based ads, visit the <a href="http://www.networkadvertising.org/choices/">Network
Advertising Initiative Opt-Out Tool</a> or <a href="http://www.aboutads.info/choices/">Digital
Advertising Alliance Opt-Out Tool</a>.
&nbsp;
Website
Analytics 
We may also partner with selected
third-party vendors[, such as [<a href="http://www.adobe.com/privacy/marketing-cloud.html">Adobe Analytics</a>,] [<a href="https://www.clicktale.com/company/privacy-policy/">Clicktale,</a>] [<a href="https://clicky.com/terms">Clicky</a>,]
[<a href="https://www.cloudflare.com/security-policy/">Cloudfare</a>,]
[<a href="https://www.crazyegg.com/privacy/">Crazy
Egg,</a>] [<a href="https://policies.yahoo.com/us/en/yahoo/privacy/products/developer/index.htm">Flurry Analytics,</a>] [<a href="https://support.google.com/analytics/answer/6004245?hl=en">Google Analytics</a>,] [<a href="https://heapanalytics.com/privacy">Heap
Analytics</a>,] [<a href="https://www.inspectlet.com/legal#privacy">Inspectlet,</a>] [<a href="https://signin.kissmetrics.com/privacy">Kissmetrics,]</a> [<a href="https://mixpanel.com/privacy/">Mixpanel,</a>]
[<a href="https://piwik.org/privacy/">Piwik,</a>]
and others], to allow tracking technologies and remarketing services on the
Site [and our mobile application] through the use of first party cookies and
third-party cookies, to, among other things, analyze and track users’ use of
the Site and our mobile application , determine the popularity of certain
content and better understand online activity. By accessing the Site, our
mobile application, you consent to the collection and use of your information
by these third-party vendors. You are encouraged to review their privacy policy
and contact them directly for responses to your
questions. We do not transfer personal information to these third-party
vendors. However, if you do not want any information
to be collected and used by tracking technologies, you can visit the
third-party vendor or the <a href="http://www.networkadvertising.org/choices/">Network
Advertising Initiative Opt-Out Tool</a> or <a href="http://www.aboutads.info/choices/">Digital
Advertising Alliance Opt-Out Tool</a>.
You should be aware that getting a new
computer, installing a new browser, upgrading an existing browser, or erasing
or otherwise altering your browser’s cookies files may also clear certain
opt-out cookies, plug-ins, or settings.&nbsp;<br>
          <br><b>5.0 THIRD-PARTY WEBSITES&nbsp; </b>&nbsp;&nbsp;<br>The Site and our mobile application may
contain links to third-party websites and applications of interest, including
advertisements and external services, that are not affiliated with us. Once you
have used these links to leave the Site or our mobile application, any
information you provide to these third parties is not covered by this Privacy
Policy, and we cannot guarantee the safety and privacy of your information.
Before visiting and providing any information to any third-party websites, you
should inform yourself of the privacy policies and practices (if any) of the
third party responsible for that website, and should take those steps necessary
to, in your discretion, protect the privacy of your information. We are not
responsible for the content or privacy and security practices and policies of
any third parties, including other sites, services or applications that may be
linked to or from the Site or our mobile application. <b>&nbsp;</b>
          <br>
          <br><b>6.0 SECURITY OF YOUR INFORMATION</b>&nbsp; &nbsp;&nbsp;<br>We use administrative, technical, and
physical security measures to help protect your personal information. While we
have taken reasonable steps to secure the personal information you provide to
us, please be aware that despite our efforts, no security measures are perfect
or impenetrable, and no method of data transmission can be guaranteed against
any interception or other type of misuse. Any information disclosed online is
vulnerable to interception and misuse by unauthorized parties. Therefore, we
cannot guarantee complete security if you provide personal information.<b></b><b>&nbsp;</b>&nbsp;<br>
          <br><b>7.0 POLICY FOR CHILDREN</b>&nbsp; &nbsp;&nbsp;<br>By using this site, you represent that you are at least the age of
majority in your state or province of residence, or that you are the age of
majority in your state or province of residence and you have given us your
consent to allow any of your minor dependents to use this site.<br>
          <br><b>8.0 CONTROLS FOR DO-NOT-TRACK
FEATURES&nbsp;</b>&nbsp;<br>Most web browsers and some mobile operating
systems [and our mobile applications] include a Do-Not-Track (“DNT”) feature or
setting you can activate to signal your privacy preference not to have data
about your online browsing activities monitored and collected. No uniform
technology standard for recognizing and implementing DNT signals has been
finalized. As such, we do not currently respond to DNT browser signals or any
other mechanism that automatically communicates your choice not to be tracked
online. If a standard for online tracking is adopted that we must follow in the
future, we will inform you about that practice in a revised version of this
Privacy Policy./Most web browsers and some mobile operating systems [and our
mobile applications] include a Do-Not-Track (“DNT”) feature or setting you can
activate to signal your privacy preference not to have data about your online
browsing activities monitored and collected. If you set the DNT signal on your
browser, we will respond to such DNT browser signals.&nbsp; &nbsp; &nbsp;<br>
          <br><b>9.0 OPTIONS REGARDING YOUR INFORMATION&nbsp;</b> &nbsp;&nbsp;<br>Account
Information
You may at any time review or change the
information in your account or terminate your account by:&nbsp;<!--[if !supportLists]-->
          <br>●&nbsp;&nbsp;Logging into your account
settings and updating your account&nbsp;<!--[if !supportLists]-->
          <br>●&nbsp;&nbsp;Contacting us using the contact
information provided below&nbsp;<!--[if !supportLists]-->
          <br>●&nbsp;[Other]
Upon your request to terminate your
account, we will deactivate or delete your account and information from our
active databases. However, some information may be retained in our files to
prevent fraud, troubleshoot problems, assist with any investigations, enforce
our Terms of Use and/or comply with legal requirements.&nbsp; &nbsp;&nbsp;<br>
          <br><b>9.1 Emails
and Communications</b>
          <br>If you no longer wish to receive
correspondence, emails, or other communications from us, you may opt-out by:&nbsp;<!--[if !supportLists]-->
          <br>●&nbsp;&nbsp;Noting your preferences at the
time you register your account with the Site [or our mobile application]<br>●&nbsp;Logging into your account
settings and updating your preferences.&nbsp;<!--[if !supportLists]-->
          <br>●Contacting us using the contact
information provided below
If you no longer wish to receive
correspondence, emails, or other communications from third parties, you are
responsible for contacting the third party directly. <b>&nbsp;</b>&nbsp;<br>CONTACT US
&nbsp;
If you have questions or comments about
this Privacy Policy, please contact us.<br>
      </p>
      
    </div>
  </div>
</div>

@endsection()
