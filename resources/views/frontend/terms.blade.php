@include('frontend.header')


<style>
    .terms {
        /* padding-top: 12rem; */
    }

    .terms .cr {
        /* margin: 8em !important; */
        margin: 16em 7em 4em 7em !important;
        justify-self: center;
        max-width: fit-content;
    }

    .cr p {
        color: black;
        font-size: 14px;
        /* font-variant: tabular-nums; */
        line-height: 1.5715;
        /* font-size: 15px; */
        font-family: Poppins;
        text-align: justify;
    }

    h3.pageTitle {
        color: var(--e-color-primary);
        margin-bottom: 30px;
        font-family: Poppins;
        font-size: 24px;
        font-weight: 600;
        line-height: 1.35;
    }

    .custom-toggle {
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        width: 400px;
        margin: 20px auto;
    }

    .toggle-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        cursor: pointer;
        background-color: #fafafa;
        border: 1px solid #d9d9d9;
        font-size: 1.5rem;
        position: relative;
        /* padding-left: 35px; */
        padding-left: 55px;
        /* Adjust space for the arrow */
    }

    .toggle-header .arrow {
        cursor: pointer;
        /* height: 8px;
        width: 8px; */
        height: 0.6rem;
        width: 0.8rem;
        position: absolute;
        left: 10px;
        top: 56%;
        transform: translateY(-50%);
        transition: transform 0.2s ease-in-out;
    }

    .toggle-header .arrow .arrow-top,
    .toggle-header .arrow .arrow-bottom {
        background-color: #666;
        height: 0.09px;
        /* height: 2px; */
        position: absolute;
        width: 100%;
        /* margin-left: 15px; */
    }

    .toggle-header .arrow .arrow-top {
        transform: rotate(45deg);
        transform-origin: bottom right;
    }

    .toggle-header .arrow .arrow-bottom {
        transform: rotate(-45deg);
        transform-origin: top right;
    }

    .toggle-header .arrow .arrow-top:after,
    .toggle-header .arrow .arrow-bottom:after {
        background-color: #fff;
        content: "";
        height: 100%;
        position: absolute;
        top: 0;
        transition: all 0.15s;
    }

    .toggle-header .arrow:hover .arrow-top:after {
        left: 0;
        transition-delay: 0.15s;
    }

    .toggle-header .arrow:hover .arrow-bottom:after {
        right: 0;
        transition-delay: 0s;
    }

    /* Rotate the arrow when the header is active (clicked) */
    .toggle-header.active .arrow {
        transform: translateY(-50%) rotate(90deg);
        /* Arrow rotates to the right */
    }

    /* .toggle-header:hover {
        background-color: #e0e0e0;
    } */

    .toggle-content {
        display: none;
        padding: 15px;
        /* background-color: #ffffff; */
        animation: slideDown 0.3s ease forwards;
        /* border-top: 1px solid #ddd; */
        border: 1px solid #ddd;
        font-size: 14px;
        font-variant: tabular-nums;
        line-height: 1.5715;
        list-style: none;
        background-color: #fff;
        border: 1px solid #d9d9d9;
        color: rgba(0, 0, 0, .85);
    }

    .toggle-content.show {
        display: block;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    ul,
    li {
        font-size: 1.5rem;
    }

    @media only screen and (max-width: 600px) {
        .terms .cr {
            margin: 11em 2.5em 4em 2.5em !important;
        }
    }
</style>


<section class="terms mb-5">
    <div class="container cr">
        <div class="terms-content">
            <h3 class="pageTitle">Terms &amp; Condition</h3>
            <p class="text-justify">PLEASE READ THESE TERMS AND CONDITIONS ("TERMS") CAREFULLY. THESE TERMS FORM A LEGAL AGREEMENT BETWEEN INFINITYFLO PRIVATE LIMITED AND YOU. BY CLICKING ON "I ACCEPT" OR "I AGREE" OR BY DOWNLOADING, INSTALLING OR OTHERWISE USING THE SERVICES, YOU ACCEPT AND AGREE TO THE TERMS CONTAINED HEREIN. IF YOU DO NOT AGREE TO THESE TERMS, DO NOT CLICK "I ACCEPT" OR "I AGREE" OR DOWNLOAD, INSTALL OR USE THE SERVICES.</p>
        </div>

        <div class="toggle-container">
            <i class="bi bi-chevron-compact-right"></i>
            <div class="toggle-header" data-target="toggle-definitions">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Definitions
            </div>
            <div class="toggle-content" id="toggle-definitions">
                <p>"Application or app." shall mean oneinfinity, the mobile application created, developed and designed by the company for providing the services.</p>
                <p>"Lender" shall mean non-banking financial company or banks with whom the company has tied up for loan sanction, which would sanction, process, and grant the loan to the customer(s), through the platform.</p>
                <p>"Company" or "We" shall mean INFINITYFLO PRIVATE LIMITED, a company incorporated under the companies act, 2013.</p>
                <p>"Customer(s)" or "You" or "End-users" shall mean any person who accesses, downloads, uses, views the platform and the services.</p>
                <p>"Loan" shall mean the loan that you may apply for through the platform and which is sanctioned and granted by Lender, subject to the applicable terms and conditions of the loan agreement.</p>
                <p>"Loan agreement" shall mean the loan agreement to be executed between lender and the customer(s) for granting the loan whether in physical or electronic form as may be applicable from time-to-time.</p>
                <p>"Online stores" shall mean windows store, android Google Play, iOS App Store, or any other online store or portal where the app will be made available by the company to the end-users, from time to time.</p>
                <p>"Outstanding amount(s)" shall mean the loan, interests, and charges due and payable by you to Lender, on respective due date(s).</p>
                <p>"Platform" shall mean the app and the website collectively.</p>
                <p>"Services" shall mean the services of granting, sanctioning, and lending of short-term loans through the platform by Lender.</p>
                <p>"Third-party platforms" shall mean social networking platforms, such as Facebook, LinkedIn, and other similar platforms.</p>
                <p>"User data" shall mean any data, information, documents, or materials submitted with the company prior to or during the use of the services.</p>
                <p>"Website" shall mean www.Oneinfinity.In, managed and operated by the company for the provision of services.</p>
            </div>
            <div class="toggle-header" data-target="toggle-services">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Services
            </div>
            <div class="toggle-content" id="toggle-services">
                <p>Through the services, you may apply for the loan, subject to the fulfillment of the eligibility criteria laid down in the mobile app. You understand that the company has been appointed by lender to collect, authenticate, track your location, verify and confirm the user data, documents, and details as may be required by lender to sanction the loan. Lender authorizes the company to collect and store the user data through the internet/website/mobile application form ("Mobile application form") available on the platform. In order to avail the services, you are required to register with the company by logging in through your third-party platforms ("User account"). During the application process, you shall be required to share and upload the user data on the mobile application form. User data shall include personal information including but not limited to your name, e-mail address, gender, date of birth, mobile number, passwords, photograph, mobile phone information including contact numbers, SMS and browsing history, data and login-in credentials of third-party platforms, financial information such as bank documents, salary slips, bank statements, PAN card, bank account no., data from credit information companies, data required for know your customer compliances, requirement and other relevant details ("Personal information"). You agree that the personal information shall always be accurate, correct, and complete. As part of the services, you authorize us to import your details and personal information dispersed over third-party platforms. You understand and acknowledge that we may periodically request updates on such personal information and we may receive such updated information from third-party platforms.</p>
                <p>All transactions undertaken on your behalf by the company will be on the basis of your express instructions/consent and will be strictly on a non-discretionary basis. You also authorize the company to get your credit information report from one or more credit information companies as decided by the company from time to time. Once you verify and upload the user data and/or other documents and details in the mobile application form, the company shall process the same. Upon the completion of the document verification by the company, the loan may be sanctioned by lender to you, subject to fitting eligibility criteria and other conditions set forth by lender for sanctioning the loan. Thereafter, you are required to fill and upload the ECS/NACH mandate form/cheque or any other document as may be required by lender. The company may collect the physical documents including signatures on those documents required for sanctioning and processing the loan. Upon the collection of documents by the company, lender shall disburse the loan subject to the terms and conditions of the loan agreement.</p>
                <p>The sanctioned loan shall be disbursed as per the mode provided in the mobile application form. You are required to repay the outstanding amount(s) to lender, on the respective due date(s) mentioned in the mobile application form.</p>
                <p>You understand and acknowledge that the company reserves the right to track your location ("Track") during the provision of services, and also in the event that you stop, cease, discontinue to use or avail the services, through deletion or uninstallation of mobile app or otherwise, till the event that your obligations to pay the outstanding amount(s) to lender exist. Deletion, uninstallation, discontinuation of our services, shall not release you from the responsibility, obligation, and liability to repay the outstanding amount(s).</p>
                <p>You understand and acknowledge that you shall be solely responsible for all the activities that occur under your user account while availing the services. You undertake that the company shall not be responsible and liable for any claims, damages, disputes arising out of use or misuse of the services. By usage of the services, you shall be solely responsible for maintaining the confidentiality of the user account and for all other related activities under your user account. The company reserves the right to accept or reject your registration for the services without obligation of explanation.</p>
                <p>You understand and acknowledge that, you are solely responsible for the capability of the electronic devices and the internet connection, you chose to run the platform. The platform’s operation or the services on your electronic device is subject to availability of hardware, software specifications, internet connection and other features and specifications, required from time to time.</p>
                <p>The user data provided during the registration is stored by the company for your convenience. You are not required to log in to your user account, every time, to use or access the platform. You understand and acknowledge that by accepting these terms, you authorize us to track, fetch and use the user data, including but not limited to your personal information, for the purpose of authentication and any updates with regards to your credentials.</p>
            </div>
            <div class="toggle-header" data-target="toggle-license">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                License
            </div>
            <div class="toggle-content" id="toggle-license">
                <p>- License to use the app: In order to use the services, you are required to download and install the app. For this purpose, you represent and warrant that you are of the age of majority as per the applicable laws to which you are subject to and are competent to understand, enter into, and comply with these terms. The company grants you a limited, non-exclusive, non-transferable, non-sublicensable, and revocable right to download, install, and use the app. The app is licensed and not sold to you and shall only be used as per these terms.</p>
                <p>- Scope of license: You may install, download, access, or use the app through the online stores on/from mobile phones, tablets, or any other electronic devices.</p>
                <p>- Maintenance & support: You acknowledge that while the company may, at its sole discretion, provide maintenance and support for the app from time to time, the company shall have no specific obligation whatsoever to furnish such services to you.</p>
                <p>- Updates/upgrades: We may launch new updates/upgrades for the app. You may subscribe to the same through the online stores. In the event, you choose not to update/upgrade the app, certain features or functionality shall not be accessible to you.</p>
            </div>

            <div class="toggle-header" data-target="toggle-restrictions">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Restrictions
            </div>
            <div class="toggle-content" id="toggle-restrictions">
                <p>You agree not to:</p>
                <p>- Use the platform or the services for committing fraud, embezzlement, money laundering, or for any unlawful and/or illegal purposes;</p>
                <p>- Reproduce, duplicate, copy, sell, resell or exploit any portion of the app;</p>
                <p>- Upload, post, email, transmit or otherwise make available any content that is unlawful, harmful, threatening, abusive, harassing, torturous, defamatory, vulgar, obscene, libelous, invasive of another’s privacy, hateful, or racially, ethnically or otherwise objectionable through the platform;</p>
                <p>- Use the platform to harm or injure any third party;</p>
                <p>- Impersonate any person or entity, on the platform;</p>
                <p>- Forge headers or otherwise manipulate identifiers in order to disguise the origin of any content transmitted through the app;</p>
                <p>- Upload, post, email, transmit or otherwise make available any content that you do not have a right to make available under any law or under contractual or fiduciary relationships (such as inside information, proprietary and confidential information learned or disclosed as part of employment relationships or under nondisclosure agreements);</p>
                <p>- Upload, post, email, transmit or otherwise make available on the platform, any content that infringes any patent, trademark, trade secret, copyright or other proprietary rights of any party;</p>
                <p>- Upload, post, email, transmit or otherwise make available on the platform, any unsolicited or unauthorized advertising, promotional materials, "junk mail," "spam", "chain letters," "pyramid schemes," or any other form of solicitation;</p>
                <p>- Upload, post, email, transmit or otherwise make available on the platform, any material that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment;</p>
                <p>- Disrupt the normal flow of or otherwise act in a manner that negatively affects other user’s ability to engage in real-time exchanges;</p>
                <p>- Interfere with or disrupt the platform or servers or networks connected to the platform, or disobey any requirements, procedures, policies or regulations of networks connected to the platform;</p>
                <p>- Intentionally or unintentionally violate any applicable local, state, national or international laws and any regulations having the force of law.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-available">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Content Available
            </div>
            <div class="toggle-content" id="toggle-content-available">
                <p>You acknowledge that the company makes no representations or warranties about the material, data, and information, such as data files, text, facts and figures, computer software, code, audio files or other sounds, photographs, videos, or other images (collectively, the "Content") which you may have access to as part of the services, or through your use of the platform. Under no circumstances, shall the company be liable in any way for any content, including, but not limited to any infringing content, any errors or omissions in content, or for any loss or damage of any kind incurred as a result of the use of any content posted, transmitted, linked from, or otherwise accessible through or made available via the platform. The content on the platform should not be regarded as an offer, solicitation, invitation, advice or recommendation to buy or sell investments, securities or any other instrument or financial products/schemes of the company (including its affiliates), unless expressly covered in these terms.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-proprietary-rights">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Proprietary Rights of The Company
            </div>
            <div class="toggle-content" id="toggle-content-proprietary-rights">
                <p>You understand, acknowledge and agree that the company is the sole owner of all rights, title and interest, including any and all intellectual property rights in the content, platform, services, logos, trade names, brand names, designs and any necessary software used in connection with the platform.</p>
                <p>There may be proprietary logos, service marks and trademarks found on the platform whether owned/used by the company or otherwise. By displaying them on the platform, the company is not granting you any license to utilize the proprietary logos, service marks, or trademarks. Any unauthorized use of the same may violate applicable intellectual property laws.</p>
                <p>You understand and acknowledge that the platform is owned by the company. Nothing under these terms shall be deemed to be a transfer in ownership, rights, title, from the company to you or any third party, in the platform. You are entitled to avail the services offered by the company during the validity of your registration with the company.</p>
            </div>

            <div class="toggle-header" data-target="toggle-content-our-partners">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Our Partners
            </div>
            <div class="toggle-content" id="toggle-content-our-partners">
                <p>- Display of various Financial Products and services offered by third parties on the OneInfinity Platform does not in any way imply, suggest, or constitute any sponsorship, endorsement, recommendation, opinion, advice or approval of OneInfinity in favour/against such third parties or their products/services. You agree that OneInfinity is in no way responsible for the accuracy, timeliness or completeness of information it may obtain from these third parties. OneInfinity is only performing the role of an intermediary/ marketplace/ facilitator to enable distribution of such products and services offered by OneInfinity’s partners (lenders, credit card companies, mutual fund companies) to You. Your interaction with any third party accessed through the OneInfinity Platform is at Your own risk, and OneInfinity will have no liability with respect to the acts, omissions, errors, representations, warranties, breaches or negligence of any such third parties or for any personal injuries, death, property damage, or other damages or expenses resulting from Your interactions with them. You should make all prior investigation You feel appropriate before proceeding with any transaction in connection with such third parties.</p>
                <p>- You agree and acknowledge that the conferment of any Financial Product to You shall be at the sole discretion of OneInfinity’s aforesaid partners while making any application through the OneInfinity Platform; OneInfinity shall not be held liable for any delay, rejection or approval of any application made through the OneInfinity Platform.</p>
                <p>- You agree and acknowledge that for undertaking any financial transaction through the OneInfinity Platform, OneInfinity may undertake OneInfinity Platform’s client/customer/user’s due diligence measures and seek mandatory information required for Know-Your-Customer (“KYC”) purpose which, as a customer, You are obliged to give, while facilitating Your request for availing any of the Financial Products in accordance with applicable law and regulations. OneInfinity may obtain sufficient information to establish, to its satisfaction or its partner banks/financial institutions/NBFCs, the identity of each client/customer/user, and to ascertain the purpose of the intended nature of the relationship between You and them. You agree and acknowledge that OneInfinity can undertake enhanced due diligence measures (including any documentation), to satisfy itself relating to such due diligence requirements in line with the requirements and obligations under applicable laws and regulations.</p>
                <p>- You agree and authorise OneInfinity to share Your personal information with the credit bureau or banks, financial institutions or NBFCs, including Fibe (formerly Early Salary), Moneywide, Kreditbee, Aditya Birla Capital and Credit Saison India, for the purpose of assessment of Your eligibility for the Financial Products and services offered, directly or indirectly, on the OneInfinity Platform.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-links-third-party">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Links to Third Party Sites
            </div>
            <div class="toggle-content" id="toggle-content-links-third-party">
                <p>The platform may contain links to other websites owned and operated by third parties who are not related to the Platform ("Linked websites"). The linked websites are not under the control of the company and the company shall not be responsible for the content of any linked websites or any hyperlink contained in a linked website and makes no representation or warranty with respect to the content of any such third party sites.</p>
                <p>The platform provides these links to you as a convenience only and the inclusion of any link does not imply any endorsement of the linked website by the company. Your access or use of such linked website is entirely at your own risk. The company shall not be a party to any transaction between you and the linked website. Your use of a linked website is subject to these terms and conditions of that respective linked website.</p>
                <p>The platform may also contain third party advertisements, if any. The display of such advertisements does not in any way imply an endorsement or recommendation by/of the relevant advertiser, its products or services. You shall independently refer to the relevant advertiser for all information regarding the advertisement and its products and/or services. The company accepts no responsibility for any interaction between you and the relevant third party and is released from any liability arising out of or in any way connected with such interaction.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-ancillary-services">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Ancillary Services
            </div>
            <div class="toggle-content" id="toggle-content-ancillary-services">
                <p>You may get access to chat rooms, blogs, feedbacks, reviews and other features ("Ancillary services") that are/may be offered from time to time on the platform and may be operated by us or by a third party on our behalf. You shall not (nor cause any third party to) use these ancillary services to perform any illegal activities (including without limitation defaming, abusing, harassing, stalking, threatening, promoting racism, or otherwise violating the legal rights, such as rights of privacy, of others) or immoral activities, falsely stating or otherwise misrepresenting your affiliation with a person or entity.</p>
                <p>Additionally, the platform may contain advice/opinions and statements of various professionals/experts/analysts, etc. The company does not endorse the accuracy, reliability of any such advice/opinions/and statements. You may rely on these, at your sole risk and cost. You shall be responsible for independently verifying and evaluating the accuracy, completeness, reliability and usefulness of any opinions, services, statements or other information provided on the platform. All information or details provided on the platform shall not be interpreted or relied upon as legal, accounting, tax, financial, investment or other professional advice, or as advice on specific facts or matters.</p>
                <p>The company may, at its discretion, update, edit, alter and/or remove any information in whole or in part that may be available on the platform and shall not be responsible or liable for any subsequent action or claim, resulting in any loss, damage and/or liability. Nothing contained herein is to be construed as a recommendation to use any product or process, and the company makes no representation or warranty, express or implied that, the use thereof will not infringe any patent, or otherwise.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-termination">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Termination
            </div>
            <div class="toggle-content" id="toggle-content-termination">
                <p>The company reserves its rights to terminate these terms in the event:</p>
                <p>- You breach any provision of these terms;</p>
                <p>- The company is required to do so under law; or</p>
                <p>- The company chooses to discontinue the services being offered or discontinue to operate the platform;</p>
                <p>- The license granted to use the app expires;</p>
                <p>- Of non-payment of outstanding amount(s).</p>
                <p>Upon termination of these terms, the rights and licenses granted to you under these terms shall cease to exist, and you must forthwith stop using the platform and the services and repay the outstanding amount(s). Notwithstanding anything contained in these terms or otherwise, the termination of these terms for any reason whatsoever, shall not affect your obligations, including but not limited to repayment of the outstanding amount(s).</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-warranties">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Disclaimer of Warranties
            </div>
            <div class="toggle-content" id="toggle-content-warranties">
                <p>You expressly understand and agree that</p>
                <p>Your use of the services and the platform is at your sole risk. The services and the platform are provided on an "As Is" and "As available" basis. The company expressly disclaims all warranties of any kind, whether express or implied, including, but not limited to the implied warranties of merchantability, fitness for a particular purpose and non-infringement. Any material downloaded or otherwise obtained through the access or use of the platform, is at your own discretion and risk and that you will be solely responsible for any damage to your computer system, electronic data or loss of data that results from the download of any such material. No advice or information, whether verbal or written, obtained by you from the company, for the services or through the platform shall create any warranty not expressly stated in these terms. The services are intended for personal, non-commercial use. You shall be solely responsible for the use, misuse, improper usage of the services and the platform. The company shall not be liable for any damages accruing out of the use of the services which have not been expressly stipulated under these terms. The company makes no warranty, including implied warranty, and expressly disclaims any obligation, that: (a) the contents are and will be complete, exhaustive, accurate or suitable to your requirements; (b) the platform or the services will meet your requirements or will be available on an uninterrupted, timely, secure, or error-free basis; (c) the results that may be obtained from the use of the platform or services will be accurate or reliable.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-indemnity">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Indemnity
            </div>
            <div class="toggle-content" id="toggle-content-indemnity">
                <p>You agree to indemnify and hold the company, and its subsidiaries, affiliates, officers, agents, co-branders or other partners, and employees, harmless from any claim or demand, including attorneys’ fees, made by any third party due to or arising out of: </p>
                <ul>
                    <li>(i) your violation of these terms;</li>
                    <li>(ii) your violation of any rights of other users of the Platform;</li>
                    <li>(iii) your use or misuse of the platform or the services;</li>
                    <li>(iv) your violation of applicable laws.</li>
                </ul>
            </div>
            <div class="toggle-header" data-target="toggle-content-liability">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Limitations of Liability
            </div>
            <div class="toggle-content" id="toggle-content-liability">
                <p>You expressly understand and agree that the company, including its directors, officers, employees, representatives or the service provider, shall not be liable for any direct, indirect, incidental, special, consequential or exemplary damages, including but not limited to, damages for loss of profits, goodwill, use, data or other intangible losses (even if the company has been advised of the possibility of such damages), resulting from:</p>
                <ul>
                    <li>(a) use or the inability to avail the services;</li>
                    <li>(b) inability to use the platform;</li>
                    <li>(c) failure or delay in providing the services or access to the platform;</li>
                    <li>(d) any performance or non-performance by the company;</li>
                    <li>(e) any damages to or viruses that may infect your electronic devices or other property as the result of your access to the platform or your downloading of any content from the platform;</li>
                    <li>(f) server failure or otherwise or in any way relating to the services.</li>
                </ul>
            </div>
            <div class="toggle-header" data-target="toggle-content-force-majeure">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Force Majeure
            </div>
            <div class="toggle-content" id="toggle-content-force-majeure">
                <p>Without limiting the foregoing, under no circumstances shall the company be held liable for any damage, loss, loss of services of platform, due to deficiency in provision of the services resulting directly or indirectly from acts of nature, forces, or causes beyond its reasonable control, including, without limitation, internet failures, computer equipment failures, telecommunication equipment failures, change in applicable regulations, including Reserve Bank of India regulations, or any other government regulations, floods, storms, electrical failure, civil disturbances, riots.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-privacy-policy">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Privacy Policy
            </div>
            <div class="toggle-content" id="toggle-content-privacy-policy">
                <p>The personal information collected/shared/uploaded for the provision of services has been exhaustively covered in our privacy policy ("Privacy policy"). Our privacy policy is available here.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-changes">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Changes
            </div>
            <div class="toggle-content" id="toggle-content-changes">
                <p>The company reserves the right to modify, change, substitute, remove, suspend, or update these terms or any information thereof at any time by posting the updated terms on the platform. Such changes shall be effective immediately upon such posting. Continued use of the services or the platform, subsequent to making the changes, shall be deemed to be your acceptance of the revised terms.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-law-jurisdiction">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Choice of Law and Jurisdiction
            </div>
            <div class="toggle-content" id="toggle-content-law-jurisdiction">
                <p>This agreement shall be construed and governed by the laws of India without regard to principles of conflict of laws. Parties further agree that the courts in Mumbai, Maharashtra, India shall have exclusive jurisdiction over such disputes.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-miscellaneous">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Miscellaneous
            </div>
            <div class="toggle-content" id="toggle-content-miscellaneous">
                <p><strong>Entire understanding:</strong> These terms, along with the loan agreement, mobile application form, and privacy policy, constitute the entire understanding between you and the company with relation to the services.</p>
                <p><strong>Waiver:</strong> The failure of the company to exercise or enforce any right or provision of these terms shall not constitute a waiver of such right or provision.</p>
                <p><strong>Time Limitation:</strong> You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to availing of the services or these terms must be filed within one (1) year after such claim or cause of action arose or be forever barred.</p>
                <p><strong>Severability:</strong> If any provision of these terms is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties’ intentions as reflected in the provision, and the other provisions of these terms shall remain in full force and effect.</p>
            </div>
            <div class="toggle-header" data-target="toggle-content-violations">
                <div class="arrow">
                    <div class="arrow-top"></div>
                    <div class="arrow-bottom"></div>
                </div>
                Violations
            </div>
            <div class="toggle-content" id="toggle-content-violations">
                <p>Please report any violations or grievances with relation to these terms to the company at <a href="mailto:info@oneinfinity.in" style="text-transform: lowercase; text-decoration:none;">info@oneinfinity.in</a></p>
            </div>
        </div>

    </div>
</section>




@include('frontend.footer')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleHeaders = document.querySelectorAll('.toggle-header');

        toggleHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const targetId = header.getAttribute('data-target');
                const targetContent = document.getElementById(targetId);

                // Toggle visibility of the content
                targetContent.classList.toggle('show');

                // Toggle the active class on the header to rotate the arrow
                header.classList.toggle('active');

                // Update the toggle icon (optional for '+' and '-' symbol)
                const icon = header.querySelector('.toggle-icon');
                if (targetContent.classList.contains('show')) {
                    icon.textContent = '-';
                } else {
                    icon.textContent = '+';
                }
            });
        });
    });
</script>