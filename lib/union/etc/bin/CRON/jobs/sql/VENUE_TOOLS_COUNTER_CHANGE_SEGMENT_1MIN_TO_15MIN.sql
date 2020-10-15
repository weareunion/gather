START TRANSACTION;
INSERT INTO slately_bigData.`venue_management_tools_counter-incremental` (segment_JSON, venue_id, group_avg, group_min, group_max, segment_weight, segment_participants, segment_start, segment_length)
SELECT '' as segment_JSON, venue_id, ROUND(AVG(group_avg)) as group_avg, MIN(group_min) as group_min, MAX(group_max) as group_max, sum(segment_weight) as segment_weight, GROUP_CONCAT(distinct segment_participants SEPARATOR ',') AS segment_participants, FROM_UNIXTIME(
            CEILING(UNIX_TIMESTAMP(segment_start)/900)*900
    ) AS segment_start_2, 900 as segment_length FROM slately_bigData.`venue_management_tools_counter-incremental` WHERE segment_length = 60 AND segment_start >= TIMESTAMP(CURRENT_TIMESTAMP() - INTERVAL 15 MINUTE) GROUP BY venue_id ;
DELETE FROM slately_bigData.`venue_management_tools_counter-incremental` WHERE DATEDIFF(now(),segment_start) > 7 AND segment_length = 60;
COMMIT;