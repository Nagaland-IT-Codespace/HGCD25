<?php
namespace App\Enums;
enum StatusEnum: string
{
    case DRAFT = 'Draft';
    case SUBMITTED = 'Submitted'; // When application is submitted by user after uploading all documents
    case UNDER_PROCESS = 'Under Process'; // When application is accepted by INO or DNO for processing
    case VERIFIED = 'Verified'; // When application is verified only by INO
    case APPROVED = 'Approved'; // When application is approved by DNO or Admin
    case REJECTED = 'Rejected';

}
