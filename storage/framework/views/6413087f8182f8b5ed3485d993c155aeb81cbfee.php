<?php echo $__env->make('frontend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .ant-layout {
        font-size: 14px;
        font-variant: tabular-nums;
        line-height: 1.5715;
        color: #000 !important;
        font-family: Poppins !important;
        margin-top: 7em !important;
    }

    .cr p,
    li {
        color: black !important;
    }


    .white {
        background-color: #fff;
    }

    .ant-layout,
    .ant-layout * {
        box-sizing: border-box;
    }

    .ant-layout {
        /* background: #f0f2f5; */
        display: flex;
        flex: auto;
        flex-direction: column;
        min-height: 0;
    }

    .ant-layout-content {
        padding: 100px 50px;
    }

    .ant-layout-content {
        flex: auto;
        min-height: 0;
    }

    .ant-row {
        margin: 0 auto !important;
        max-width: 1440px;
    }

    .align-items-center {
        align-items: center;
    }

    .ant-row-space-around {
        justify-content: space-around;
    }

    .ant-row,
    .ant-row:after,
    .ant-row:before {
        display: flex;
    }

    .ant-row {
        flex-flow: row wrap;
        min-width: 0;
    }

    .ant-col-xs-24 {
        display: block;
        flex: 0 0 100%;
        max-width: 100%;
    }

    .ant-col {
        max-width: 100%;
        min-height: 1px;
        position: relative;
    }

    h3.pageTitle {
        color: var(--e-color-primary);
        margin-bottom: 30px !important;
    }

    .ant-typography h3,
    div.ant-typography-h3,
    div.ant-typography-h3>textarea,
    h3.ant-typography {
        color: rgba(0, 0, 0, .85);
        font-size: 24px;
        font-weight: 600;
        line-height: 1.35;
        margin-bottom: .5em;
        font-family: Poppins !important;
    }

    .ant-typography h4,
    div.ant-typography-h4,
    div.ant-typography-h4>textarea,
    h4.ant-typography {
        color: rgba(0, 0, 0, .85);
        font-size: 20px;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: .5em;
        font-family: Poppins !important;
    }

    .ant-typography {
        color: rgba(0, 0, 0, .85);
        overflow-wrap: break-word;
    }

    h4.ant-typography {
        color: var(--e-color-black);
        font-family: Poppins;
        font-weight: 400;
    }

    .privacy-content p,
    .text-justify {
        text-align: justify;
    }

    .privacy-content p {
        margin: 0;
        color: #000 !important;
        font-size: 14px !important;
        /* line-height: normal !important; */
        line-height: 1.5715 !important;
        /* text-transform: initial; */
        margin-bottom: 1em;
        margin-top: 0;
        font-family: Poppins !important;

    }

    .privacy-content a {
        /* -webkit-text-decoration-skip: objects; */
        background-color: initial !important;
        color: #1890ff !important;
        cursor: pointer;
        outline: none !important;
        text-decoration: none !important;
        transition: color .3s;
        font-size: 14px !important;
        font-family: Poppins !important;
        text-transform: none !important;
    }

    .privacy-content a:active,
    a:focus,
    a:hover {
        outline: 0;
        text-decoration: none;
    }

    @media (min-width: 992px) {
        .ant-col-lg-24 {
            display: block;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (min-width: 768px) {
        .ant-col-md-24 {
            display: block;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .ant-layout-content {
        padding: 40px 50px;
    }


    @media  only screen and (max-width: 600px) {
        .ant-layout-content {
            padding: 25px 20px;
        }
    }
</style>
<section class="ant-layout white">
    <main class="ant-layout-content">
        <div class="site-layout-content">
            <div class="ant-row ant-row-space-around align-items-center" style="margin-left: -16px; margin-right: -16px;">
                <div class="ant-col ant-col-xs-24 ant-col-md-24 ant-col-lg-24" style="padding-left: 16px;padding-right: 16px;">
                    <h3 class="ant-typography pageTitle">Privacy Policy</h3>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">1. INTERPRETATION</h4>
                        <p>For the purpose of this policy:</p>
                        <p>1.1 The terminologies used herein, unless expressly defined otherwise, shall carry the same meaning and interpretation as in terms of Use of OneInfinity</p>
                        <p>1.2 Whenever the context so requires, "you", "your", "user", and "User" shall mean any natural or legal person who browses through the Platform or avail services through the website, and the terms "we", "us", and "our" shall mean the Company.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">2. INTRODUCTION</h4>
                        <p>OneInfinity is committed to ensuring that Your privacy is protected. This policy is provided to explain Our policies and practices regarding the collection, use, and disclosure of information.</p>
                        <p>For the purpose of performing its obligations for the provided service, OneInfinity will be required to obtain data from the User, which shall be used by OneInfinity for processing. By undergoing the sign-up process, you consent to us collecting your personal data including your images and we will store, use or disclose such data in accordance with this Privacy Policy.</p>
                        <p>This Privacy Policy delineates the way of collection, use, retention, and management of your information by us. By using OneInfinity or voluntarily sharing information on OneInfinity, you consent to be bound by the terms of this Privacy Policy, and you further consent to the collection, use, retention, and management of your information under the terms and conditions of this Privacy Policy.</p>
                        <p>We, therefore, advise you to read this policy before using our Platform. If these terms, in parts or whole, are not acceptable to you, then you are advised not to use OneInfinity or our services that require the collection, use, or retention of your information. </p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">3. DEFINITION</h4>
                        <p><strong>3.1. "Information"</strong> means your data that is collected during your usage of OneInfinity and includes Personal, Non-personal, and financial information.</p>
                        <p><strong>3.2. "Personal Information"</strong> means personally identifiable information that can be used to contact or identify you or the User. Personal information includes, without limitation, the name, email address, residential and permanent address, date of birth, phone number, aadhar card, pan card, photos/images and other financial information, including, without limitation, income, expenses, payment details, bank accounts information and other information as required from time to time.</p>
                        <p><strong>3.3. "Non-personal Information"</strong> means information such as cookies, log data, third-party analytics for data collection, and analysis that your browser sends whenever you use OneInfinity, and includes, without limitation, information such as your computer’s Internet Protocol address, browser type, browser version, pages of OneInfinity that you visit, time and date of your visit, time spent on those pages, unique device identifiers, the mobile device you use (including the hardware models), your mobile device unique ID, IP address of your mobile device, your mobile operating system, type of mobile Internet browser you use, unique device identifiers, location, device data, and other diagnostic data.</p>
                        <p><strong>3.4. "User"</strong> shall mean the User who uses the platform and provides information on the Platform.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">4. COLLECTION OF INFORMATION</h4>
                        <p><strong>4.1. Non-personal Information:</strong></p>
                        <p>We collect your Non-personal Information, such as the device ID, device model, IP address, browser type, operating system, and the time and frequency of use of OneInfinity when you browse through OneInfinity or use OneInfinity to avail of the services.</p>
                        <p><strong>4.2. Personal Information:</strong></p>
                        <p>We collect your Personal Information only when you voluntarily provide it to us while:</p>
                        <p>(a) Browsing OneInfinity</p>
                        <p>(b) Creating an account on OneInfinity</p>
                        <p>(c) Availing Services available on OneInfinity</p>
                        <p>(d) Inquiring about our services</p>
                        <p>(e) Providing feedback</p>
                        <p>(f) Using live chat support</p>
                        <p>(g) Availing service support</p>
                        <p>(h) Providing information on our Platform</p>
                        <p><strong>• Camera Access:</strong> We require access to Your mobile device camera in case some part of the journey is to be completed on your mobile device for clicking Your selfie and uploading photos/images for Your KYC compliance and/or for uploading any other necessary documents on the application.</p>
                        <p><strong>• Storage:</strong> We may require this permission so that Your documents can be securely downloaded and saved on Your phone and so You can upload any required documents. This helps in providing a smooth and seamless experience while using the application.</p>
                        <p><strong>• Third-Party Information:</strong> Only after the explicit consent, We or the Financing Partner may also work closely with third parties (including, for example, information bureaus, account aggregators, business partners, technical sub-contractors, analytics providers, search information providers, etc.) and may lawfully receive information about You from such sources. Such data may be combined with data collected on the application and other information provided in this policy. Such third parties will provide the same or equal protection to the user data as provided in this policy.</p>
                        <p><strong>4.3. Disclaimer:</strong></p>
                        <p>4.3.1 We do not collect any Personal Information of any individual except when a such individual voluntarily shares Personal Information on our Platform with prior written consent. Upon such voluntary disclosure of Personal Information and data, we may further verify and collate the information and data from information available in the public domain (as permitted by law) to prevent identity theft, fraud, etc.</p>
                        <p>4.3.2 <strong> Limitation of collection and use of Information</strong></p>
                        <p>4.3.2.1 Features of the ONEINFINITY Service may require registration, which involves provision to ONEINFINITY of an email address, a password and the User's pin code (collectively the "Registration Information"). In order to benefit from the full functionality of the Service, the User may also need to provide the User's relevant account credentials ("Account Credentials") to allow OneInfinity to access the status of the fulfillment of Transactions ("Account Information") for the purpose of transaction processing.</p>
                        <p>4.3.2.2 The transaction information including User data is strictly restricted to OneInfinity employees and contractors, as needed, and in accordance with specific internal procedures and safeguard governing access, in order to operate, develop or improve the Service. These individuals have been selected in accordance with OneInfinity's security policies and practices and are bound by confidentiality obligations. They may be subject to discipline, including termination and criminal prosecution, if they fail to meet these obligations.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">5. RETENTION OF DATA</h4>
                        <p>You can choose to edit, change or delete your Personal Information, in parts or whole, that you have provided on OneInfinity. We will retain your Personal Information as long as you continue to remain a user of OneInfinity by using services available on OneInfinity or until it is required for us to retain your Personal Information to resolve disputes, if any, or to enforce our legal agreements and policies.</p>
                        <p>When the user requests Oneinfinity to delete the user's account for the service, the user's data will be permanently expunged from Oneinfinity's primary production servers and further access to the user's account will not be possible. Oneinfinity will also promptly disconnect any connection Oneinfinity had established to the user's account information and delete all account credentials. However, anonymized data, consisting of aggregate data derived from the user's account information, may remain on Oneinfinity's production servers indefinitely. The user's data may also remain on a backup server or media. Oneinfinity keeps these backups to ensure Oneinfinity's continued ability to provide the service to the user in the event of malfunction or damage to oneinfinity's primary production servers. Oneinfinity will also keep the audit data on its servers from a compliance perspective. Oneinfinity may allow companies to subscribe to email newsletters and from time to time may transmit emails promoting oneinfinity. Oneinfinity subscribers have the ability to opt-out of receiving oneinfinity's promotional emails and to terminate their newsletter subscriptions by following the instructions in the emails. Opting out in this manner will not end transmission of service-related emails, such as email alerts.</p>
                        <p><strong>5.1 Data deletion requests</strong></p>
                        <p>You can request your data to be deleted by:</p>
                        <p>5.1.1 Emailing us at support@oneinfinity.in with the subject line "Delete My Data" or</p>
                        <p>5.1.2 Contacting us via our contact us page available at <a href="https://oneinfinity.in/contact">https://oneinfinity.in/contact</a> and submitting a "Delete My Data" request.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">6. DISCLOSURE OF DATA</h4>
                        <p>6.1. We will not voluntarily disclose your stored information without your prior written consent.</p>
                        <p>6.2. Notwithstanding the foregoing, OneInfinity reserves the right (and the User authorizes OneInfinity) to share or disclose the User's personal information when OneInfinity determines, in its sole discretion, that the disclosure of such information is necessary or appropriate:</p>
                        <p>6.2.1 To enforce OneInfinity's rights against the User or in connection with a breach by the User of this Privacy and Security Policy or OneInfinity's Terms of Use;</p>
                        <p>6.2.2 To prevent prohibited or illegal activities; or</p>
                        <p>6.2.3 When required by any applicable law, rule regulation, subpoena or other legal process.</p>
                        <p>6.3. <strong>Permitted Disclosure:</strong> Notwithstanding anything provided in the foregoing clause, we will disclose your information in parts or whole under the following conditions:</p>
                        <p>6.3.1 <strong>Third-Party Service Provider (Financial Institutions):</strong> For providing Services available on OneInfinity which is rendered to you through the help of third-party service providers (Financial Institutions) such as Banks, Non-Banking Financial Company (NBFC), Insurers, Brokers, Mutual Funds, AMCs, etc. we may be required to share your information, in part or whole, to third-party service providers; thereby we will share your information with such third-party service provider as required for rendering such Services to you. Such disclosure, however, shall be made under strict confidentiality obligations, which inter alia restricts disclosure of your information to any person or entity by a such third party, its employees, associates, and affiliates.</p>
                        <p>6.3.2 Disclosure for Law Enforcement: Company will disclose your information to law enforcement agencies, Governmental authorities, or any other third party if so is required by a court order or under any law enforced from time to time, in good faith, or to enforce the terms of use or privacy policy of OneInfinity.</p>
                        <p>6.3.3 Legal Requirements: We will disclose your information in good faith and belief if such action is necessary to comply with a legal obligation or to protect and defend the rights and property and restrict the legal liability of the Company, or to prevent or investigate possible wrongdoing in connection with the Platform or to protect the personal safety of the users of OneInfinity.</p>
                        <p>6.3.4 We shall not be held liable for disclosure of the User Information or Statistical Information in accordance with this Privacy Commitment or in terms of any other agreements with you.</p>
                        <p>6.3.5 We may disclose User Information to any of our associates and affiliates without any limitation, and you hereby give your consent for the same.</p>
                        <p>6.3.6 We may disclose the User Information, to third parties, without limitation, for the following reasons, and you hereby give your irrevocable consent for the same:</p>
                        <p>6.3.7 To enforce the Terms and Conditions of the products or services. Or</p>
                        <p>6.3.8 To protect or defend our rights, interests and property or that of our associates and affiliates, or that of our or our Affiliate’s employees, consultants etc. or</p>
                        <p>6.3.9 For fraud prevention purposes. or</p>
                        <p>6.3.10 As permitted or required by law.</p>
                        <p>6.3.11 We may disclose the User Information to third parties for the following, among other purposes, and will make reasonable efforts to bind them to the obligation to keep the same secure and confidential and an obligation to use the information for the purpose for which the same is disclosed, and you hereby give your irrevocable consent for the same:</p>
                        <p>(a) For participation in any telecommunication or electronic clearing network.</p>
                        <p>(b) For advertising. or</p>
                        <p>(c) Facilitating joint product promotion campaigns. or</p>
                        <p>(d) For availing of the support services from third parties, e.g. collecting subscription fees and notifying or contacting you regarding any problem with, or the expiration of, any services availed by you.</p>
                        <p>6.3.12 For sharing with third-parties information obtained once (such information will only be taken one time, the information obtained once will only be shared) with your consent from your mobile device like device location, device information (including storage, model, installed apps, Wi-Fi, mobile network), transactional and promotional SMS, communication information including contacts and call logs, for statistical modelling, scoring and any other purpose that will help us in providing you with optimal and high-quality services.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">7. USE OF INFORMATION</h4>
                        <p><strong>7.1. By the Company:</strong></p>
                        <p>7.1.1 We will use your information to provide Services available on OneInfinity to you; to notify you about changes in our Services or terms and conditions for such Services, or deliver any administrative notices, alerts, advice, notifications, and communication relevant to Your use of any of the facilities on the application through social media, Instant messaging, SMS and other mediums; to allow you to participate in interactive features of OneInfinity when you choose to do so; to provide service support, gather valuable information or analysis to improve our Platform and Services provided thereof.</p>
                        <p>7.1.2 We will use your information and analyse your usage of the application to improve and develop our Platform and Services provided thereof by gathering and analysing surveys taken, feedback, reviews, and ratings provided or posted by you.</p>
                        <p>7.1.3 To fulfil KYC (Know Your User) compliances under anti-money laundering laws applicable from time to time.</p>
                        <p>7.1.4 We shall collect any Files &amp; Media (Images) for facilitating KYC journey, lending services and such purposes as may be required by the Lending Partners or as per applicable law.</p>
                        <p>7.1.5 To provide service support and promptly and satisfactorily respond to and resolve your queries, complaints, and grievances, if any.</p>
                        <p>7.1.6 Undertake market research, project planning, and problem troubleshooting and to protect against error, fraud or other criminal activity</p>
                        <p>7.1.7 Disclose to employees, agents and representatives on a need-to-know basis as part of the services</p>
                        <p>7.1.8 Disclose to relevant and authorised financial service providers and Financing partners who have partnered with OneInfinity to provide loan facilities to the users.</p>
                        <p>7.1.9 Assist in resolving disputes in relation to loan facilities made available by Financing Partners</p>
                        <p>Disclose to the information bureau and such other authorities as may be required by applicable laws and such other purposes as provided in this policy. </p>
                        <p>OneInfinity may also be required to share Personal Information with its third-party contractors, such as financial service providers, banks, or NBFCs/Financing Partners. In such cases, OneInfinity shares the information securely and ensures that all personal information recipients comply with confidentiality, fidelity and secrecy obligations and sign covenants in this regard. Such third parties will provide the same or equal protection to the user data as provided in this policy. OneInfinity may make information available to third parties that are financial and non- financial companies, such as service providers, government agencies, courts, legal investigators, and other non-affiliated third parties, as requested by You or Your authorised representative, or otherwise when required or permitted by law.</p>
                        <p>The account information and profile are password protected. OneInfinity will never ask for Your password through unsolicited phone calls or emails. However, if any person claiming to be an authorised representative of OneInfinity contacts You, we request You not to provide any information to such person and instead immediately contact OneInfinity as per the contact details provided in this policy. OneInfinity shall not be liable for any loss of Personal Information provided to such persons.</p>
                        <p>7.2<strong> By Third-Party Service Provider:</strong> We engage third-party service providers (Financial Institutions) to render certain services; thereby, your information will be used by such third- party service providers solely and strictly to provide the services to you. Sharing of Information is limited to the extent necessary for rendering such services and is shared under the strict obligation of confidentiality subject to the permitted disclosure provided under this Privacy Policy. Your information will be used by third-party service providers for the following purposes as stipulated under this policy.</p>
                        <p>7.2.1<strong> Web Analytics:</strong> We use third-party service providers to monitor and use our Platform to track and report traffic on the Platform; thereby, the web analytics service providers may use the collected data to contextualise and personalise advertisements of their own advertising network. Kindly refer to their respective privacy practices to understand your data usage by these service providers. You can access the Privacy Policy and terms of use of these service providers on their respective websites.</p>
                        <p>7.2.2<strong> Other third-party service providers and facilitators:</strong> Your information will be used by other third parties, such as banks, NBFCs, etc., when you use OneInfinity for availing services on OneInfinity.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">8. THIRD-PARTY LINKS AND CONTENTS THEREOF</h4>
                        <p>Our Platform may link to third-party websites and services that are outside our control. Such third- party websites may collect and store information and data about the user. The Company takes no responsibility for the privacy practices followed by these websites or the content available thereon. The Company takes no liability for any loss or damage arising directly or indirectly from using such websites by browsing or transacting through them.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">9. SECURITY OF DATA</h4>
                        <p>9.1 We have implemented and employed existing and necessary internet security methods and technologies to secure the information and data, to prevent loss and misuse of the information, and to data disclosed through unauthorised access from third-party, alteration, disclosure, or destruction of your information, username, password, transaction information and other stored Information on OneInfinity.</p>
                        <p>9.2 From the time the user submits the user's login id and password, these communications between the user's computer and oneinfinity are encrypted using secure sockets layer (ssl3) technology. Ssl enables user and server applications to communicate in a way that is designed to prevent eavesdropping, tampering and message forgery.</p>
                        <p>9.3 The Platform is scanned regularly for any vulnerabilities to make your usage of OneInfinity as safe as possible.</p>
                        <p>9.4 We assure the compliance and adoption of all such measures as required under the applicable laws from time to time.</p>
                        <p>9.5 The protection and confidentiality of your username, password, and other login credentials is solely your responsibility, and we recommend you not to disclose it to anyone, including any third party, including anyone claiming to be the representative of the Company or its affiliates. We never call or ask for such information from users. We shall not bear any responsibility or liability for such unauthorised disclosure or usage of your information or action taken from your account and its consequences thereof.</p>
                        <p>9.6 Notwithstanding anything provided under this policy, the Company shall be under no obligation for the permitted disclosure of information per the terms of this policy.</p>
                        <p>9.7 Although we use our best endeavours to protect and secure the information and data shared or transmitted over the internet cannot be completely guaranteed; hence we cannot provide an absolute hundred percent guaranteed security of the information provided by the user. Therefore, we disclaim all warranties and liabilities in respect of:</p>
                        <p>9.7.1 Any loss or injury caused to you as a result of voluntary disclosure of your Personal Information to any unauthorised party.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">10. Online Session Information And Use Is Only Used To Improve The User's Experience</h4>
                        <p>When the User visits ONEINFINITY, OneInfinity may collect technical and navigational information, such as computer browser type, Internet protocol address, pages visited, and average time spent on ONEINFINITY. This information may be used, for example, to alert the User to software compatibility issues, or it may be analyzed to improve ONEINFINITY design and functionality. "Cookies" are alphanumeric identifiers in the form of text files that are inserted and stored by the User's web browser on the User's computer's hard drive. ONEINFINITY may set and access cookies on the User's computer to track and store preferential information about the User. ONEINFINITY may gather information about the User through cookie technology. For example, ONEINFINITY may assign a cookie to the User, to limit the amount of times the User see particular information or to help better determine which information or preference settings to serve to the User. Please note that most Internet browsers will allow the User to stop cookies from being stored on the User's computer and to delete cookies stored on the User's computer. If the User or other users choose to eliminate cookies, the full functionality of the Service may be impaired for the User. ONEINFINITY's cookies are encrypted so that only ONEINFINITY can interpret the information stored in them. Third party cookies: The wesite allows cookies of social plugins of several third parties. This enables a user to share content of the Website on certain social networks. These plugins also enhance the user friendliness of the Website. For example, with the Facebook plugin on the Website, users can simply register themselves on the Website with their Facebook account details. The (use of the) data collected by these third parties via the social plugins are exclusively determined by such third party as ONEINFINITY cannot read these cookies (nor can these parties read the cookies of ONEINFINITY). For information regarding the third party cookies, please read the respective third party's policies.</p>
                        <p>Web beacons are images embedded in a web page or email for the purpose of measuring and analyzing site usage and activity. OneInfinity, or third party service providers acting on OneInfinity's behalf, may use web beacons to help us analyze Site usage and improve the Service. OneInfinity may use third party service providers to help us analyze certain online activities. For example, these service providers may help us measure the performance of OneInfinity's online campaigns or analyze visitor activity on ONEINFINITY. OneInfinity may permit these service providers to use cookies and other technologies to perform these services for ONEINFINITY. OneInfinity does not share any personal information about OneInfinity's users with these third party service providers, and these service providers do not collect such information on OneInfinity's behalf. OneInfinity's third party service providers are required to comply fully with this Privacy</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">11. AMENDMENTS</h4>
                        <p>We update our Privacy Policy to comply with applicable laws as amended from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We will notify you through a notification on our Platform as and when the Privacy Policy is updated or amended. You are requested to periodically review the policy to apprise yourself of the requisite changes. All such changes shall be effective immediately upon posting the updated policy on the Platform.</p>
                    </div>
                    <div class="privacy-content">
                        <h4 class="ant-typography pageTitle">12. GRIEVANCE REDRESSAL</h4>
                        <p>Oneinfinity uses stringent security measures to prevent loss, misuse or alteration of information under our control. If any user has sufficient reason to believe that their data has been compromised or there has been a breach of security, you may write to us immediately on the contact details given in this policy so that we may take suitable measures to either rectify the breach and inform the concerned authorities if need be. If you have any questions related to this Privacy Policy or any other grievance related to your information’s privacy, you can write to us at <a href="mailto:support@OneInfinity.in">support@oneinfinity.in</a> or call us at +91 7718866649. We will endeavor to readress your issues to the best of our abilities.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>


<?php echo $__env->make('frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\frontend\policy.blade.php ENDPATH**/ ?>