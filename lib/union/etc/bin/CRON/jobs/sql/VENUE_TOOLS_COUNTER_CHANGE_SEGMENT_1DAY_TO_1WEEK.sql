START TRANSACTION;
INSERT INTO slately_bigData.`venue_management_tools_counter-incremental` (segment_JSON, venue_id, group_avg, group_min, group_max, segment_weight, segment_participants, segment_start, segment_length)
SELECT '' as segment_JSON, venue_id, ROUND(AVG(group_avg)) as group_avg, MIN(group_min) as group_min, MAX(group_max) as group_max, sum(segment_weight) as segment_weight, GROUP_CONCAT(distinct segment_participants SEPARATOR ',') AS segment_participants, FROM_UNIXTIME(
            CEILING(UNIX_TIMESTAMP(segment_start)/604800)*604800
    ) AS segment_start, 604800 as segment_length FROM slately_bigData.`venue_management_tools_counter-incremental` WHERE segment_length = 86400 AND segment_start >= NOW() - INTERVAL 24 HOUR GROUP BY venue_id ;
DELETE FROM slately_bigData.`venue_management_tools_counter-incremental` WHERE DATEDIFF(now(),segment_start) > 365 AND segment_length = 86400;
COMMIT;