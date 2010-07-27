-- alter table events add startTime DateTime not null default '0000-00-00 00:00:00';
-- alter table events add endTime DateTime not null default '0000-00-00 00:00:00';

UPDATE events e, days d
SET 
    e.startTime=Timestamp(Concat(d.day, ' ', substr(e.time,1,2), ':', substr(e.time, 3,2))),
    e.endTime=TIMESTAMPADD(MINUTE, 30*length, Timestamp(Concat(d.day, ' ', substr(time,1,2), ':', substr(time, 3,2))))
WHERE e.dayId=d.id;
