START TRANSACTION;
INSERT INTO slately_bigData.`venue_management_tools_counter-incremental` (segment_JSON, venue_id, group_avg, group_min, group_max, segment_weight, segment_participants, segment_start, segment_length)
SELECT '' as segment_JSON, venue, floor(avg(post)) as group_avg,min(post) as group_min,max(post) as group_max, count(*) as segment_weight,GROUP_CONCAT(distinct user_account SEPARATOR ',') AS segment_participants, stamp as segment_start, 60 as segment_length FROM slately_bigData.`venue_management_tools_counter-delta` GROUP BY HOUR(stamp), MINUTE(stamp), venue ;
DELETE FROM slately_bigData.`venue_management_tools_counter-delta`;
COMMIT;