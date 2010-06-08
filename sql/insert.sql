truncate eventTypes;
insert into eventTypes VALUES 
	(1, 'Performance', 'performance', '#111111', '#FF7F47'),
	(2, 'Game / Contests', 'game_contests', '#3A3939;', '#75FF62'),
	(3, 'Art / Creative', 'art_creative', '#000000', '#017CFD'),
	(4, 'Academic', 'academic', '#000000', '#FB0000'),
	(5, 'Jap. Culture', 'jap_culture', '#000000', '#9B9B9B');

truncate rooms;
insert into rooms (id, name) VALUES 
    (1, 'Main Events 1'),
    (2, 'Panel Room 1'),
    (3, 'Panel Room 2');

truncate days;
insert into days (id, day) VALUES 
    (1, '2010-02-19');

truncate events;
insert into events (id, roomId, time, dayId, name, length, eventType1, eventType2, eventType3, eventType4) VALUES 
    (NULL, 1, '1000', 1, 'Gavin says its closed sucka', 3, 0, 0, 0, 0),
    (NULL, 1, '1200', 1, 'The Final Fantasy Fight Tournament', 2, 1, 1, 2, 2),
    (NULL, 1, '1300', 1, 'The Gauntlet - Round 1', 2, 2, 2, 2, 2),
    (NULL, 1, '1400', 1, 'Charity Auction', 2, 1, 1, 1, 1),
    (NULL, 1, '1500', 1, 'The Beautiful Losers - Concert', 2, 1, 1, 5, 5),
    (NULL, 1, '1600', 1, 'AMV Contest', 2, 3, 3, 3, 3),

    (NULL, 2, '1000', 1, 'Dolphin claims this room', 3, 0, 0, 0, 0),
    (NULL, 2, '1200', 1, 'Anime Debate', 2, 1, 1, 4, 4),
    (NULL, 2, '1300', 1, 'Cosplay Swimsuit Contest', 2, 1, 1, 2, 2),
    (NULL, 2, '1400', 1, 'Anime Physics', 2, 4, 4, 4, 4),
    (NULL, 2, '1500', 1, 'Magic The Gathering - Draft Tournament', 2, 2, 2, 2, 2),
    (NULL, 2, '1600', 1, 'King for a Day - Cosplay Guide', 2, 3, 3, 3, 3),

    (NULL, 3, '1000', 1, 'this one is up for grabs', 4, 0, 0, 0, 0),
    (NULL, 3, '1200', 1, 'The history of manga', 2, 4, 4, 4, 4),
    (NULL, 3, '1300', 1, 'Anime Idol', 2, 1, 1, 2, 2),
    (NULL, 3, '1400', 1, 'Left for Dead 2 - Tournament', 2, 2, 2, 2, 2),
    (NULL, 3, '1500', 1, 'Cosplay Chess', 2, 1, 1, 2, 2);
