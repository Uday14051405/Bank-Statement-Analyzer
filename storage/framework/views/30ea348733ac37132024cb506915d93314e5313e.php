<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREEMENT FOR SALES AND PURCHASE OF RECEIVABLES</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 22px;
        }

        .indent {
            margin-left: 40px;
        }

        .indent1 {
            margin-left: 1px;
        }

        .clause {
            margin-top: 20px;
        }

        .definition {
            margin-top: 10px;
            margin-left: 40px;
        }

        .number {
            font-weight: bold;
        }

        .number {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .indent {
            margin-left: 20px;
        }

        .indent p {
            margin: 5px 0;
        }

        .indent p.indent {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <h1>AGREEMENT FOR SALES AND PURCHASE OF RECEIVABLES</h1>

    <p>
        This Agreement for Sales and purchase of receivables (“<strong>Agreement</strong>”) is made between the following on <?php echo e($other_data['formattedDate'] ?? ''); ?> day of <?php echo e($other_data['monthYear'] ?? ''); ?>:
    </p>
    <p>
        <!-- <strong><?php echo e($other_data['vendor_name'] ?? ''); ?></strong>, <strong><?php echo e($other_data['vendor_address'] ?? ''); ?></strong>  -->
        Company (ies) that present their invoices for the purpose of sales of receivables(hereinafter referred to as “<strong>Vendor</strong>” or “” which expression shall, unless repugnant to the context or meaning thereof, be deemed to mean and include its successors, related companies and permitted assigns) of the <strong>First Part</strong>;
    </p>
    <p>
    <strong>AND</strong>
    </p>
    <p>
    <strong><?php echo e($companyDetail->company_name ?? ''); ?></strong>, a company incorporated under the Companies Act, [2013], having CIN <?php echo e($companyDetail->cin ?? ''); ?>, with address <?php echo e($companyDetail->company_address ?? ''); ?>, <?php echo e($companyDetail->company_city ?? ''); ?>, <?php echo e($companyDetail->company_state ?? ''); ?> <?php echo e($companyDetail->company_pincode ?? ''); ?> (hereinafter referred to as “<strong>Company</strong>” or “<strong>platform</strong>” or “<strong>HEPL</strong>” which expression shall, unless repugnant to the context or meaning thereof, be deemed to mean and include its successors and permitted assigns) of the <strong>Second Part</strong>.
    </p>
    <p>
    <strong>AND</strong>
    </p>
    <p>
        <strong><?php echo e($other_data['financier_name'] ?? ''); ?></strong> and address at <strong><?php echo e($other_data['financier_address'] ?? ''); ?></strong> (hereinafter referred to as “Financier”, which expression shall, unless repugnant to the context or meaning thereof, be deemed to mean and include its successors and permitted assigns) of the Third Part.
    </p>
    <p>
        (Vendor, HEPL and Financier are collectively referred to as “Parties” and individually as “Party”)
    </p>

    <div class="clause">
        <p><strong>WHEREAS</strong></p>

        <div class="indent">
            <p>1. HEPL is, inter alia, engaged in the business of providing independent technology intermediary services to facilitate online financing transaction.</p>
        </div>

        <div class="indent">
            <p>2. Pursuant to the online facilitation process followed on the Platform, the Vendor has agreed to sell and the Financier has agreed to purchaser the right and interest in the Invoices Receivables (as defined below) (“<strong>Financing Transaction</strong>”). </p>
        </div>

        <div class="indent">
            <p>3. In furtherance to the same, the Vendor and the Financier are desirous of entering into this Agreement with HEPL for the purpose of recording the terms and conditions with respect to the Financing Transaction. HEPL is desirous of executing this Agreement in the capacity of an administrator/facilitator.</p>
        </div>
    </div>

    <div class="clause">
        <p><strong>NOW THEREFORE, IN CONSIDERATION OF THE MUTUAL AGREEMENTS, COVENANTS, REPRESENTATIONS AND WARRANTIES SET FORTH IN THIS AGREEMENT, AND PROMISES CONTAINED IN THIS AGREEMENT, THE SUFFICIENCY OF WHICH IS HEREBY ACKNOWLEDGED, IT IS HEREBY AGREED BETWEEN THE PARTIES THAT:</strong></p>
    </div>





    <h1>1. DEFINITIONS AND INTERPRETATION</h1>

    <div class="clause">
        <p><strong>1.1 DEFINITIONS</strong></p>

        <p><span>The following capitalized terms used in this Agreement shall have the meanings respectively assigned to them:</span></p>

        <div class="indent">
            <p class="number">1.1.1</p>
            <p class="indent"><strong>“Anchor”</strong> means the client/customer of the Vendor, which has purchased goods and/or availed services from the Vendor(s) and the Vendor has raised Invoices on such Person.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.2</p>
            <p class="indent"><strong>“Applicable Laws”</strong> means all laws statutes, constitutions, treaties, rules, codes, ordinances, regulations, rulings, whether federal, state, local, foreign, international, as may be applicable, and all orders, judgments, injunctions, decrees, permits, certificates and licenses of any Governmental Authority and all interpretations of any of the foregoing by a Governmental Authority having jurisdiction or any arbitrator or other judicial or quasi-judicial tribunal.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.3</p>
            <p class="indent"><strong>“Business Day”</strong> means any day on which banks are open for normal banking transactions excluding Saturdays, Sundays and any day which is a public holiday in India.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.4</p>
            <p class="indent"><strong>“Due Date”</strong> is the date on or before which the payment against the relevant Invoices is payable by the Anchor, details of which is more particularly provided in <strong>Annexure 1</strong>.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.5</p>
            <p class="indent"><strong>“Designated Account”</strong> means the Bank account registered by user, during registering on the Rumbble platform and notified to HEPL through the Platform. </p>
        </div>

        <div class="indent">
            <p class="number">1.1.6</p>
            <p class="indent"><strong>“Financier Account”</strong> means the bank account of the Financier as registered in the records of HEPL.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.7</p>
            <p class="indent"><strong>“Force Majeure Event”</strong> means any circumstance which are beyond reasonable control of the concerned party whose obligations it affects and which that party is unable to avoid by the exercise of reasonable foresight and diligence.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.8</p>
            <p class="indent"><strong>“Governmental Authority”</strong> includes the President of India, the Government of India, the Governor and the Government of any State in India, any Ministry or Department of the same, any municipal or local government, any authority or private body exercising powers conferred by Applicable Law and any court, tribunal or other judicial or quasi-judicial body, and shall include, without limitation, a stock exchange and any regulatory body.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.9</p>
            <p class="indent"><strong>“Invoices”</strong> means the unpaid Invoices raised by the Vendor on the Anchor and listed on the Platform.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.10</p>
            <p class="indent"><strong>“Person”</strong> includes an individual, natural person, corporation, partnership, joint venture, incorporated or unincorporated body or association, company, Governmental Authority and in case of a company and a body corporate shall include their respective successors and assigns and in case of any individual his/her respective legal representative, administrators, executors and heirs and in case of trust shall include the trustee(s) for the time being and from time to time. The term “Persons” shall be construed accordingly.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.11</p>
            <p class="indent"><strong>“Platform”</strong> means the electronic platform created by HEPL under the brand name “Rumbble” to provide online services, available at “[]”.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.12</p>
            <p class="indent"><strong>“Receivables”</strong> means the amount of Rs. payable by the concerned Anchor to the Vendor under the Invoices on or before the Due Date, and the right to receive the same is proposed to be sold to the Financier by the Vendor.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.13</p>
            <p class="indent"><strong>“Vendor Account”</strong> means the bank account of each Vendor as registered in the records of HEPL.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.14</p>
            <p class="indent"><strong>“Vendor Facilitation Agreement”</strong> means the service level facilitation agreement executed between the Vendor and HEPL.</p>
        </div>

        <div class="indent">
            <p class="number">1.1.15</p>
            <p class="indent"><strong>“Vendor Facilitation Fee”</strong> means the amount payable to HEPL for facilitating the transaction, as agreed between HEPL and the Vendor.</p>
        </div>

    </div>

    <div class="clause">
        <p><strong>1.2 INTERPRETATION</strong></p>

        <p><span>The following rules of interpretation shall apply in the Agreement unless the context requires otherwise or is expressly specified otherwise:</span></p>

        <div class="indent">
            <p class="number">1.2.1</p>
            <p class="indent">a reference to a <strong>“Party”</strong> shall be construed so as to include its respective successors and permitted assigns;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.2</p>
            <p class="indent">1.2.2 time is of the essence in the performance of the Parties’ respective obligations. If any time period specified herein is extended, such extended time shall also be of the essence;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.3</p>
            <p class="indent">singular includes plural and conversely and a gender includes all genders;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.4</p>
            <p class="indent">the expression “this Clause” shall, unless followed by reference to a specific provision, be deemed to refer to the whole Clause (not merely the sub-Clause, paragraph or other provision) in which the expression occurs;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.5</p>
            <p class="indent">unless the contrary is expressly stated, no Clause in this Agreement limits the extent or application of another Clause;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.6</p>
            <p class="indent">any reference to books, files, records or other information or any of them, means books, files, records or other information or any of them, in any form or in whatever medium held including paper, electronically stored data, magnetic media, film and microfilm;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.7</p>
            <p class="indent">headings to Clauses, Parts and Paragraphs of Schedules / Annexures and Schedules / Annexures are for convenience only and do not affect the interpretation of this Agreement;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.8</p>
            <p class="indent">the words “include”, “including” and “in particular” shall be construed as being by way of illustration or emphasis only and shall not be construed as, nor shall they take effect as, limiting the generality of any preceding words;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.9</p>
            <p class="indent">where a word or phrase is defined, its other grammatical forms have a corresponding meaning;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.10</p>
            <p class="indent">in the event of any disagreement or dispute between the Parties regarding the materiality or reasonableness of any matter including of any event, occurrence, circumstance, change, fact, information, document, authorisation, proceeding, act, omission, claims, breach, default or otherwise, the opinion of HEPL as to the materiality or reasonableness of any of the foregoinng shall be final and binding on other Parties;</p>
        </div>

        <div class="indent">
            <p class="number">1.2.11</p>
            <p class="indent">a reference to any agreement or document is to that agreement or document as amended, novated, supplemented, varied or replaced from time to time, except to the extent prohibited by this or that other agreement or document; and</p>
        </div>

        <div class="indent">
            <p class="number">1.2.12</p>
            <p class="indent">a reference to any legislation or to any provision of any legislation includes any amendment, modification or re-enactment of it, any legislative provision substituted for it and all regulations and statutory instruments issued thereunder.</p>
        </div>
    </div>




    <div class="indent">
        <p class="number"><strong>2. CONSIDERATION; PAYMENT FLOW AND CONSEQUENCES</strong></p>
        <div class="indent">
            <p class="number">2.1</p>
            <p class="indent">Within [2] Business Days from the date of this Agreement, the Vendor shall be paid the Financed Amount less Vendor Facilitation Fees () from the Designated Account, out of the amount deposited by the Financier towards the acquisition of the earmarked Invoices, by crediting the Vendor Account. </p>
        </div>
    </div>

    <div class="indent">
        <p class="number"><strong>3. REPRESENTATION AND WARRANTY</strong></p>
        <div class="indent">
            <p class="number">3.1</p>
            <p class="indent">Each Party hereby represents and warrants to the other that:</p>
        </div>
        <div class="indent">
            <p class="number">3.1.1</p>
            <p class="indent">it is competent and has all power, approval, authorisation, consent to execute, deliver and perform its obligations, undertakings and covenants under this Agreement;</p>
        </div>
        <div class="indent">
            <p class="number">3.1.2</p>
            <p class="indent">3.1.2 the Agreement constitutes legal, valid and binding obligations, enforceable against it, in accordance with its terms;</p>
        </div>

        <div class="indent">
            <p class="number">3.2</p>
            <p class="indent">In addition to Clause 4.1 above, the Vendor hereby represents and warrants to the other as under:</p>
        </div>
        <div class="indent">
            <p class="number">3.2.1</p>
            <p class="indent">The Vendor is not in violation of any Applicable Law;</p>
        </div>
        <div class="indent">
            <p class="number">3.2.2</p>
            <p class="indent">The Vendor is not bound by any contract, which may restrict its right or ability to enter into or perform this Agreement, or which would be breached as a result of execution and performance of this Agreement;</p>
        </div>

    </div>

    <div class="indent">
        <p class="number"><strong>4. COST; INDEMNIFICATION AND LIMITATION</strong></p>
        <div class="indent">
            <p class="number">4.1</p>
            <p class="indent">Each Party hereby represents and warrants to the other that:</p>
            <div class="indent">
                <p class="number">4.1</p>
                <p class="indent">Each Party shall bear its respective costs and expenses (including but not limited to legal fees) incurred in connection with the enforcement of, the preservation of any rights or disputes arising between the Parties under this Agreement.</p>
            </div>
            <div class="indent">
                <p class="number">4.2</p>
                <p class="indent">The Vendor shall bear all stamp duty, registration or other similar tax or charge payable in connection with the entry into, performance or enforcement of this Agreement, with no obligation on other parties.</p>
            </div>
            <div class="indent">
                <p class="number">4.3</p>
                <p class="indent">The Vendor (the “<strong>Indemnifying Party</strong>”) shall, forthwith on demand, indemnify the other Parties (the “<strong>Indemnified Party</strong>”) against any loss or liability (other than any loss or liability resulting from the gross negligence, wilful misconduct or misrepresentation of the Indemnified Party) which the Indemnified Party incurs as a consequence of any breach by the Indemnifying Party of its obligations or representations under the Agreement.</p>
            </div>
            <div class="indent">
                <p class="number">4.4</p>
                <p class="indent">HEPL disclaims any liability with respect to information set out in the report attached to every Invoices on the Platform. Subject to the aforesaid, even if there is any liability of HEPL then it is hereby expressly clarified that in no event shall the liability of HEPL exceed the 1% of the Vendor Facilitation Fee actually received by HEPL in respect of the Invoices in dispute.</p>
            </div>

            <div class="indent">
                <p class="number">4.5</p>
                <p class="indent">The transmission of information over the internet not being completely secure, HEPL will strive to protect data. However, HEPL cannot guarantee the security of the data while it is being transmitted to the online Platforms or any other transmission, and the same is at the risk of the information provider. The Vendor acknowledges the adequacy of the data protection measures adopted by HEPL. Further, HEPL shall endeavor to provide the Vendor an advance notice of any repairs and maintenance on the Platform, provided, however, that, HEPL shall not be liable in respect of any loss caused to the Vendor due to such repairs and maintenance of the Platform or on account of failure to provide an advance notice. HEPL shall use best efforts to rectify any errors on the Platform and restore operations of the Platform.</p>
            </div>

            <div class="indent">
                <p class="number">4.6</p>
                <p class="indent">Except for any liability which cannot by law be excluded or limited, no Party shall be liable to the other Party or any other third party claiming through the other Party for indirect, incidental, special, punitive or exemplary or consequential damages, including without limitation, damages for loss of profits, business interruption, loss of goodwill incurred by the other Party arising out of, or relating to this Agreement whether framed as a breach of warranty, in tort, contract, or otherwise even if a Party has been advised of the possibility of such damages.</p>
            </div>

        </div>

    </div>



    <div class="clause">
        <p><strong>5. TERM AND TERMINATION</strong></p>

        <div class="indent">
            <p class="number">5.1</p>
            <p class="indent">This Agreement is valid until terminated in accordance with the provisions of this Agreement.</p>
        </div>

        <div class="indent">
            <p class="number">5.2</p>
            <p class="indent">Termination by the Vendor. The Vendor may terminate this Agreement in the event the Vendor does not receive consideration as contemplated in Clause 3 above within 5 Business Days of execution of this Agreement. It is hereby expressly clarified that this Agreement cannot be terminated by the Vendor after the Vendor has received the amount mentioned in Clause 3.</p>
        </div>

        <div class="indent">
            <p class="number">5.3</p>
            <p class="indent">Termination by the Financier. The Financier may terminate this Agreement in the event the Vendor and/or HEPL commits a breach of any of its representations and warranties or fails to fulfil its obligations under this Agreement.</p>
        </div>

        <div class="indent">
            <p class="number">5.4</p>
            <p class="indent">The termination of this Agreement shall be subject to right of the Parties accrued prior to the termination of this Agreement and accordingly not relieve either Party of its obligations related to period prior to termination and antecedent breaches.</p>
        </div>

        <div class="indent">
            <p class="number">5.5</p>
            <p class="indent">Notwithstanding anything contained elsewhere in this Agreement, neither Party shall be liable towards the other Party if they are not able to perform any of their obligation(s) under this Agreement due to Force Majeure event.</p>
        </div>

    </div>

    <div class="clause">
        <p><strong>6. CONFIDENTIALITY</strong></p>

        <div class="indent">
            <p class="number">6.1</p>
            <p class="indent">The Financier and the Vendor shall ensure that all the terms and conditions of this Agreement and all information relating to the information accessed from the Platform is kept confidential (“<strong>Confidential Information</strong>”).</p>
        </div>

        <div class="indent">
            <p class="number">6.2</p>
            <p class="indent">The Financier and the Vendor shall not disclose any information relating to this Agreement to any third party, without the prior written consent of HEPL.</p>
        </div>

        <div class="indent">
            <p class="number">6.3</p>
            <p class="indent">Confidential Information does not include information which:</p>
        </div>

        <div class="indent">
            <p class="number">6.3.1</p>
            <p class="indent">is known to the Financier and/or Vendor, as the case may be, at the time of disclosure as evidenced by written records;</p>
        </div>

        <div class="indent">
            <p class="number">6.3.2</p>
            <p class="indent">has become publicly known and made generally available through no wrongful act of the Financier and/or Vendor, as the case may be;</p>
        </div>

        <div class="indent">
            <p class="number">6.3.3</p>
            <p class="indent">the Financier and/or Vendor, as the case may be, lawfully receives from a third party without restriction on disclosure, provided such disclosure is without breach of a non-disclosure obligation; or</p>
        </div>

        <div class="indent">
            <p class="number">6.3.4</p>
            <p class="indent">has been independently developed by the Financier and/or Vendor, as the case may be, without access to HEPL’s Confidential Information.</p>
        </div>
    </div>



    <div class="clause">
        <p><strong>7. GOVERNING LAW AND DISPUTE RESHEPLUTION</strong></p>

        <div class="indent">
            <p class="number">7.1</p>
            <p class="indent">This Agreement shall be governed by and construed in accordance with the laws of the Republic of India.</p>
        </div>

        <div class="indent">
            <p class="number">7.2</p>
            <p class="indent">Subject to arbitration as per Clause 8.3 below, the courts at Mumbai shall have the jurisdiction over disputes arising out of this Agreement. The Parties agree to negotiate in good faith to resolve any dispute between them arising out of or relating to this Agreement. If, within 30 (thirty) Business Days after one Party has notified the other Party in writing of such a dispute, the Parties are unable to resolve the dispute as aforesaid, the disputes or differences shall be referred for final and binding arbitration at the request of the disputing Parties upon written notice to that effect to the other Parties. The arbitration proceedings shall be conducted in accordance with the provisions of the Arbitration and Conciliation Act, 1996 (“<strong>Arbitration Act</strong>”), in force at the relevant time (which is deemed to be incorporated into this Agreement by reference). All proceedings of such arbitration shall be in the English language and all documents submitted (including those submitted as filings, evidence or exhibits) shall be certified English translations if in a language other than English. The venue and seat of the arbitration shall be Mumbai. The arbitration shall be conducted by a sole arbitrator, who shall be appointed by the mutual consent of the disputing Parties. In the event the disputing Parties are unable to mutually decide on the sole arbitrator, the appointment of the arbitrator shall be in accordance with the Arbitration Act. Nothing shall preclude a Party from seeking interim equitable or injunctive relief, or both, from any court having jurisdiction to grant the same. The pursuit of equitable or injunctive relief shall not be a waiver of the duty of the Parties to pursue any remedy for monetary losses through the arbitration described in this Clause 8.3.</p>
        </div>


    </div>



    <div class="clause">
        <p><strong>8. NOTICE</strong></p>

        <div class="indent">
            <p class="number">8.1</p>
            <p class="indent">Any communication to be made under or in connection with this Agreement shall be made in writing and, unless otherwise stated, may be made by electronic mail or letter. The address and email (and the department or officer, if any, for whose attention the communication is to be made) of each Party for any communication or document to be made or delivered under or in connection with this Agreement is:</p>

            <br>

            <p class="indent">In the case of Financier</p>
            <p class="indent"><b>Name: </b><?php echo e($other_data['financier_name'] ?? ''); ?></p>
            <p class="indent"><b>Address: </b><?php echo e($other_data['financier_address'] ?? ''); ?></p>
            <p class="indent"><b>Email: </b><?php echo e($email ?? ''); ?></p>
            <br>
            <p class="indent">In the case of Vendor</p>
            <p class="indent"><b>Name: </b><?php echo e($other_data['vendor_name'] ?? ''); ?></p>
            <p class="indent"><b>Designation: </b><?php echo e($other_data['vendor_desgination'] ?? ''); ?></p>
            <p class="indent"><b>Address: </b><?php echo e($other_data['vendor_address'] ?? ''); ?></p>
            <p class="indent"><b>Email: </b><?php echo e($other_data['customerEmail'] ?? ''); ?></p>
            <br>
            <p class="indent">In the case of HEPL:</p>
            <p class="indent"><b>Name: </b>Name</p>
            <p class="indent"><b>Designation: </b>Designation</p>
            <p class="indent"><b>Address: </b>Address</p>
            <p class="indent"><b>Email: </b>Email</p>
        </div>

        <p class="indent">or any substitute address, email or department or officer as the Financier and/or Vendor, as the case may be, may notify to HEPL (or HEPL may notify to the Financier and Vendor, if a change is made by HEPL) by not less than [5] Business Days’ notice.</p>


        <p class="indent">Any communication or document made or delivered by one person to another under or in connection with this Agreement will only be effective: (i) if by way of letter, when it has been left at the relevant address or [5] Business Days after being deposited in the post postage prepaid in an envelope addressed to it at that address and, if a particular department or officer is specified as part of its address details provided under Clause 9.1, if addressed to that department or officer; (ii) if by way of an electronic email, when actually received in readable form; and (iii) Any communication or document to be made or delivered to HEPL will be effective only when actually received by it and then only if it is expressly marked for the attention of the department or officer identified with its signature below (or any substitute department or officer as it shall specify for this purpose).</p>

        <div class="indent">
            <p class="number">8.2</p>
            <p class="indent">Any communication to be made between HEPL and any other Party under or in connection with this Agreement may be made by electronic mail or other electronic means, if HEPL and the other relevant Party: (i) agree that, unless and until notified to the contrary, this is to be an accepted form of communication; (ii) notify each other in writing of their electronic mail address and/or any other information required to enable the sending and receipt of information by that means; and (iii) notify each other of any change to their address or any other such information supplied by them.</p>
        </div>

        <div class="indent">
            <p class="number">8.3</p>
            <p class="indent">Any notice given under or in connection with this Agreement must be in English.</p>
        </div>
    </div>




    <div class="clause">
        <p><strong>9. MISCELLANEOUS</strong></p>

        <div class="indent">
            <p class="number">9.1</p>
            <p class="indent"><strong>Conflict of Interest</strong></p>
            <p class="indent">The Financier and Vendor hereby acknowledges that HEPL is acting as facilitator through the Platform and shall undertake or has already undertaken activities on behalf of such other Persons. The Financier hereby unconditionally waives it rights to raise any concern or claim any losses arising from or out of HEPL’s contracting with other persons including on account of conflict of interest in performing their respective obligations on behalf of and for the benefit of other Persons on the Platform.</p>
        </div>

        <div class="indent">
            <p class="number">9.2</p>
            <p class="indent"><strong>Waiver</strong></p>
            <p class="indent">Save and except as expressly provided in the Agreement, no exercise, or failure to exercise, or delay in exercising any right, power or remedy vested in the Agreement shall constitute a waiver of that or any other right, remedy or power.</p>
        </div>

        <div class="indent">
            <p class="number">9.3</p>
            <p class="indent"><strong>No Partnership</strong></p>
            <p class="indent">Nothing contained in the Agreement shall constitute partnership and/or agency relationship between the Parties. The Financier and/or the Vendor shall not create any obligations on HEPL or make any representation on behalf of HEPL, unless specifically authorized by HEPL.</p>
        </div>

        <div class="indent">
            <p class="number">9.4</p>
            <p class="indent"><strong>Severability</strong></p>
            <p class="indent">If any provision of the Agreement is rendered void, illegal or unenforceable in any respect under applicable law, the validity, legality and enforceability of the remaining provisions shall not in any way be affected or impaired. Should any provision of the Agreement be or become ineffective for reasons beyond the control of the Parties, the Parties shall use reasonable endeavours to agree upon a new provision which shall as nearly as possible have the same commercial effect as the ineffective provision.</p>
        </div>

        <div class="indent">
            <p class="number">9.5</p>
            <p class="indent"><strong>Binding Effect</strong></p>
            <p class="indent">This Agreement shall be binding on the Financier and the Vendor and their respective successors and permitted assigns. Neither Financier nor the Vendor shall assign its rights or obligations under the Agreement to any other person without prior written consent of HEPL. However, HEPL shall be entitled to freely transfer/assign the rights and/or obligations under the HEPL to any other person.</p>
        </div>

        <div class="indent">
            <p class="number">9.6</p>
            <p class="indent"><strong>Disparagement</strong></p>
            <p class="indent">The Financier and the Vendor shall not make or pass any disparaging statement against HEPL and/or the online portals.</p>
        </div>

        <div class="indent">
            <p class="number">9.7</p>
            <p class="indent"><strong>Entire Agreement</strong></p>
            <p class="indent">The Parties hereto confirm and acknowledge that this Agreement shall constitute the entire agreement between them and shall supersede and override all previous communications, either oral or written, between the Parties with respect to the subject matter of this Agreement, and no agreement or understanding varying or extending the same shall be binding upon either Party unless arising out of the specific provisions of this Agreement.</p>
        </div>

        <div class="indent">
            <p class="number">9.8</p>
            <p class="indent"><strong>Modifications</strong></p>
            <p class="indent">No amendment or addition to this Agreement shall be binding on either of the Parties unless agreed to in writing and executed by them through their duly authorized representatives.</p>
        </div>

        <div class="indent">
            <p class="number">9.9</p>
            <p class="indent"><strong>Counterparts</strong></p>
            <p class="indent">This Agreement may be executed in counterparts. Each counterpart shall be treated as an original and shall be capable of being enforced without reliance on the other counterparts as an original document.</p>
        </div>
    </div>
    <br>
    <div style="page-break-before: always;"></div>
    <br>
    <div class="clause">
        <p><strong>ANNEXURE 1 EARMARKED INVOICES</strong></p>

        <p><strong>As per the individual invoices listed on the platform.</strong></p>

        <p><strong>Designated Details-</strong></p>
        <p><strong>Account Name - <?php echo e($companyDetail->company_name ?? ''); ?></strong></p>
        <p><strong>Account number - 853210066158</strong></p>
        <p><strong>IFSC Code - DBSS0IN0853</strong></p>
        <p><strong>Bank Name - DBS BANK INDIA LIMITED</strong></p>
        <p><strong>Branch - ANDHERI EAST</strong></p>
    </div>
    <br>


    <div style="page-break-before: always;"></div>

    <p><strong>THE PARTIES HERETO HAVE SET AND SUBSCRIBED THEIR RESPECTIVE HANDS TO THESE PRESENTS ON THE DATE MENTIONED BELOW TO BE EFFECTIVE FROM THE DATE FIRST MENTIONED ABOVE:</strong></p>
    <br><br>
    <p>SIGNED AND DELIVERED</p>
    <p>BY THE WITHINNAMED <strong>“Vendor”</strong></p>
    <p>BY THE HAND OF its Authorized Signatory</p>
    <p>SD/- -</p>
    <p>Mr./ MS.: <?php echo e($other_data['vendor_name'] ?? ''); ?></p>
    <br><br>
    <p>SIGNED AND DELIVERED</p>
    <p>BY THE WITHINNAMED <strong>“Financier”</strong></p>
    <p>BY THE HAND OF its Authorized Signatory</p>
    <p>SD/- -</p>
    <p>Mr./ MS.: <?php echo e($other_data['financier_name'] ?? ''); ?></p>


</body>

</html><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views\emails\agreement_payment.blade.php ENDPATH**/ ?>