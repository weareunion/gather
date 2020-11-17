create table if not exists maint_testing_tree
(
    type text null comment 'OPTIONS:
category
sub_category
test
assertion
fail_path
pass_path
cleanup',
    dir text null,
    on_pass varchar(36) null,
    on_fail varchar(36) null,
    id varchar(36) null,
    name_internal text null,
    name_external text null,
    critical tinyint(1) null
);

create table if not exists slately_maint.maint_testing_tree
(
    type text null comment 'OPTIONS:
category
sub_category
test
assertion
fail_path
pass_path
cleanup',
    dir text null,
    on_pass varchar(36) null,
    on_fail varchar(36) null,
    id varchar(36) null,
    name_internal text null,
    name_external text null,
    critical tinyint(1) null
);

create table if not exists slately_users.`security_auth-general_account_profiles`
(
    TABLE_SEQUENCE int null,
    account_id varchar(36) null,
    external_authentication_token longtext null,
    external_authentication_provider longtext null,
    first_name varchar(767) null,
    last_name varchar(767) null,
    phone_number varchar(15) null,
    email_address varchar(767) null,
    phone_activated tinyint null,
    email_activated tinyint null,
    password_hashed longtext null
);

create index `security_auth-general_account_profiles_account_id_index`
    on slately_users.`security_auth-general_account_profiles` (account_id);

create index `security_auth-general_account_profiles_email_address_index`
    on slately_users.`security_auth-general_account_profiles` (email_address);

create index `security_auth-general_account_profiles_first_name_index`
    on slately_users.`security_auth-general_account_profiles` (first_name);

create index `security_auth-general_account_profiles_last_name_index`
    on slately_users.`security_auth-general_account_profiles` (last_name);

create index `security_auth-general_account_profiles_phone_number_index`
    on slately_users.`security_auth-general_account_profiles` (phone_number);

create table if not exists slately_users.`security_auth-persistence`
(
    TABLE_SEQUENCE int null,
    user longtext null,
    additional_data longtext null,
    age timestamp null,
    token text null,
    IP_address longtext null,
    account_id varchar(36) null,
    IP_trusted tinyint null
)
    comment 'This table is responsible for remembering authentication tokens and pulling up thier data upon login.';

create table if not exists slately_users.`security_auth_accounts_registration-holding`
(
    TABLE_SEQUENCE bigint null,
    account_phone_number bigint null,
    account_email varchar(767) null,
    account_name_first varchar(767) null,
    account_name_last varchar(767) null,
    verification_phone_number tinyint null,
    verification_email tinyint null,
    added_on timestamp null,
    password_hashed longtext null,
    last_sms_sent timestamp null,
    last_email_sent timestamp null,
    guid varchar(36) null
)
    comment 'Registration holding while account is confirmed.';

create index `security_auth_accounts_registration-holding_account_email_index`
    on slately_users.`security_auth_accounts_registration-holding` (account_email);

create table if not exists slately_bigData.`venue_management_tools_counter-active_count`
(
    venue_id varchar(36) null,
    count int null,
    updated datetime null
);

create index `venue_management_tools_counter-active_count_venue_id_index`
    on slately_bigData.`venue_management_tools_counter-active_count` (venue_id);

create table if not exists slately_bigData.`venue_management_tools_counter-delta`
(
    venue varchar(36) null,
    delta int null,
    pre int null,
    post int null,
    user_account varchar(36) null,
    stamp datetime default CURRENT_TIMESTAMP null,
    TABLE_SEQUENCE bigint null
)
    comment 'keeps track of change in count';

create index venue_management_tools_counter_delta_venue_index
    on slately_bigData.`venue_management_tools_counter-delta` (venue);

create table if not exists slately_bigData.`venue_management_tools_counter-incremental`
(
    TABLE_SEQUENCE bigint auto_increment
        primary key,
    segment_start timestamp null,
    segment_length int null,
    group_avg float null,
    group_min float null,
    group_max float null,
    segment_JSON text null,
    segment_participants text null,
    venue_id varchar(36) null,
    segment_weight int null
);

create index `venue_management_tools_counter-incremental_venue_id_index`
    on slately_bigData.`venue_management_tools_counter-incremental` (venue_id);

create table if not exists slately_venues.`venues-lookup`
(
    TABLE_SEQUENCE bigint auto_increment
        primary key,
    GUID varchar(36) null comment 'This is the global identifier for the venue. All attributes and lookups should lead and link to this ID.',
    display_name varchar(512) null,
    venue_description mediumtext null,
    location_address varchar(767) null,
    location_city varchar(767) null,
    location_city_latitude float null,
    location_city_longitude float null,
    location_state varchar(3) null,
    location_zip int null,
    location_map_latitude float null,
    location_map_longitude float null,
    hidden tinyint(1) default 0 null comment 'filter out in search results (for non-payment, violations, etc)',
    tags text null
)
    comment 'A quick lookup table for fast searching';

create index venue_lookup_display_name_index
    on slately_venues.`venues-lookup` (display_name);

create index venue_lookup_hidden_index
    on slately_venues.`venues-lookup` (hidden);

create index venue_lookup_location_city_index
    on slately_venues.`venues-lookup` (location_city);

create index venue_lookup_location_city_latitude_index
    on slately_venues.`venues-lookup` (location_city_latitude);

create index venue_lookup_location_city_longitude_index
    on slately_venues.`venues-lookup` (location_city_longitude);

create index venue_lookup_location_map_latitude_index
    on slately_venues.`venues-lookup` (location_map_latitude);

create index venue_lookup_location_map_longitude_index
    on slately_venues.`venues-lookup` (location_map_longitude);

create index venue_lookup_location_state_index
    on slately_venues.`venues-lookup` (location_state);

create index venue_lookup_location_zip_index
    on slately_venues.`venues-lookup` (location_zip);

create index venue_quick_lookup_GUID_index
    on slately_venues.`venues-lookup` (GUID);

create index venue_quick_lookup_TABLE_SEQUENCE_index
    on slately_venues.`venues-lookup` (TABLE_SEQUENCE);

create table if not exists slately_users.`venues-user_associations`
(
    venue_id varchar(36) null,
    user_id varchar(36) null,
    `rank` int null comment '--------- Requests ---------
-2: Outgoing Request
-1: Incoming Request

--------- Associations ---------

VIEW ONLY:
0: Just Listed
1: Staff
MANAGE BELOW
2: Shift Leader
3: Sub-Manager
4: Location Manager
5: Regional Manager
CORE INFORMATION MODIFICATIONS
10: Owner',
    JSON longtext null,
    TABLE_SEQUENCE bigint auto_increment
        primary key
);

create index `venues-user_associations_user_id_index`
    on slately_users.`venues-user_associations` (user_id);

create index `venues-user_associations_venue_id_index`
    on slately_users.`venues-user_associations` (venue_id);

