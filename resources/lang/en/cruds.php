<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],
    'covidCase'      => [
        'title'          => 'Covid Cases',
        'title_singular' => 'Covid Case',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => '',
            'case_identity'             => 'Case Identity',
            'case_identity_helper'      => '',
            'source_case_to_link'       => 'Related Source Case Identity',
            'gender'                    => 'Gender',
            'gender_helper'             => '',
            'age'                       => 'Age',
            'age_helper'                => '',
            'date_detected'             => 'Date Detected',
            'date_detected_helper'      => '',
            'date_recovered'            => 'Date Recovered',
            'date_recovered_helper'     => '',
            'location_detected'         => 'Location Detected',
            'location_detected_helper'  => '',
            'description'               => 'Description',
            'description_helper'        => '',
            'status'                    => 'Status',
            'status_helper'             => '',
            'deceased_date'             => 'Date of Death',
            'deceased_date_helper'      => '',
            'created_at'                => 'Created at',
            'created_at_helper'         => '',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => '',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => '',
            'source'                    => 'Source',
            'source_helper'             => '',
            'infection_source'          => 'Infection Source',
            'infection_source_helper'   => '',
            'nationality'               => 'Nationality',
            'nationality_helper'        => '',
            'symptomatic_date'          => 'Symptomatic Date',
            'symptomatic_date_helper'   => '',
            'displayed_symptoms'        => 'Displayed Symptoms',
            'displayed_symptoms_helper' => '',
            'case_number_from' => 'Case number from',
            'case_number_to' => 'Case number to',
            'case_number_from_helper' => '',
            'case_number_to_helper' => ''
        ],
    ],
    'auditLog'       => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => '',
            'description'         => 'Description',
            'description_helper'  => '',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => '',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => '',
            'user_id'             => 'User ID',
            'user_id_helper'      => '',
            'properties'          => 'Properties',
            'properties_helper'   => '',
            'host'                => 'Host',
            'host_helper'         => '',
            'created_at'          => 'Created at',
            'created_at_helper'   => '',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => '',
        ],
    ],
];
