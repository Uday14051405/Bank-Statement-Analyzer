<?php
// app/Enums/EventTypeEnum.php

namespace App\Enums;

enum EventTypeEnum: string
{
    case OTP_NOT_VERIFIED = 'OTP not verified';
    case OTP_VERIFIED = 'OTP verified';
    case BANK_STATEMENT_UPLOADED = 'Bank statement uploaded';
    case BANK_STATEMENT_SAVED = 'Bank statement saved';
    case BANK_STATEMENT_ANALYSIS_RUN = 'Run Bank Statement Analysis';
    case BSA_REPORT_DOWNLOADED = 'Download BSA Report';
    case CONTACT_US_SUBMITTED = 'Contact Us';
}
