USE `elan`;

-- -----------------------------------------------------
-- Locations data
-- -----------------------------------------------------

INSERT INTO locations ( Name, address) values ( 'Bamity', '33664 Sachtjen Parkway');
INSERT INTO locations ( Name, address) values ( 'Toughjoyfax', '330 Transport Hill');
INSERT INTO locations ( Name, address) values ( 'Stronghold', '0 Warner Way');
INSERT INTO locations ( Name, address) values ( 'Holdlamis', '7 Novick Street');
INSERT INTO locations ( Name, address) values ( 'Bytecard', '55802 Sage Place');
INSERT INTO locations ( Name, address) values ( 'Span', '8 Mandrake Circle');
INSERT INTO locations ( Name, address) values ( 'Bytecard', '4 Elka Road');
INSERT INTO locations ( Name, address) values ( 'Sonsing', '200 Donald Street');
INSERT INTO locations ( Name, address) values ( 'Trippledex', '003 Merrick Alley');
INSERT INTO locations ( Name, address) values ( 'Bitchip', '6 John Wall Center');

-- -----------------------------------------------------
-- images data
-- -----------------------------------------------------

INSERT INTO images ( path) VALUES ( '/public/images/Flowdock.png');
INSERT INTO images ( path) VALUES ( '/public/images/Zontrax.jpg');
INSERT INTO images ( path) VALUES ( '/public/images/Fnatic-Logo.png');
INSERT INTO images ( path) VALUES ( '/public/images/SKT1-logo.png');
INSERT INTO images ( path) VALUES ( '/public/images/Flexity-logo.png');
INSERT INTO images ( path) VALUES ( '/public/images/Fusion_logo.png');
INSERT INTO images ( path) VALUES ( '/public/images/G2_logo.png');
INSERT INTO images ( path) VALUES ( '/public/images/underrated.jpg');
INSERT INTO images ( path) VALUES ( '/public/images/TSM_logo');
INSERT INTO images ( path) VALUES ( '/public/images/C9_logo.png');

-- -----------------------------------------------------
-- Events data
-- -----------------------------------------------------

INSERT INTO events ( name, description, type, start, end) values ( 'Vagram', 'Dyche', 'Quizz', '2020-08-23', '2022-03-16');
INSERT INTO events ( name, description, type, start, end) values ( 'Quo Lux', 'Olenchenko', 'Shop', '2020-05-06', '2021-06-21');
INSERT INTO events ( name, description, type, start, end) values ( 'It', 'Smorthwaite', 'other', '2020-07-16', '2022-04-27');
INSERT INTO events ( name, description, type, start, end) values ( 'Opela', 'Copyn', 'Tournement', '2021-01-21', '2021-11-05');
INSERT INTO events ( name, description, type, start, end) values ( 'Alpha', 'Zellick', 'Quizz', '2020-10-27', '2021-05-20');
INSERT INTO events ( name, description, type, start, end) values ( 'Konklux', 'Tomisch', 'other', '2021-10-15', '2022-04-24');
INSERT INTO events ( name, description, type, start, end) values ( 'Tin', 'Caseley', 'Shop', '2020-06-06', '2021-05-03');
INSERT INTO events ( name, description, type, start, end) values ( 'Solarbreeze', 'Auchterlony', 'other', '2021-01-11', '2021-06-24');
INSERT INTO events ( name, description, type, start, end) values ( 'Voyatouch', 'Bradburne', 'other', '2021-02-20', '2022-04-26');
INSERT INTO events ( name, description, type, start, end) values ( 'Subin', 'Batte', 'Shop', '2021-04-22', '2022-09-20');

-- -----------------------------------------------------
-- States data
-- -----------------------------------------------------

INSERT INTO states ( type) values ( 'enabled');
INSERT INTO states ( type) values ( 'disabled');

-- -----------------------------------------------------
-- Lans data
-- -----------------------------------------------------

INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'PolyLan', 'Lan Suisse orgalisée a EPFL a LAusanne', 34984, '2020-06-16', '2021-11-23' , id FROM states WHERE type LIKE 'disabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'NumerikGames', 'Le Numerik Games est un festival de jeux vidéos organisé par la maison d ailleur comportant plusieurs LANS gaming', 59957, '2021-02-03', '2021-06-15' , id FROM states WHERE type LIKE 'enabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'MontreuxLANS', 'LANS multigaming de monteux', 63359, '2021-08-16', '2021-01-29' , id FROM states WHERE type LIKE 'disabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'Bigtax', 'Bigtax est une lan francaise porposant plusuers tournois sur des jeux E-sportif', 12615, '2021-04-19', '2021-06-26' , id FROM states WHERE type LIKE 'disabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'LOL_LAN', 'La LOL_Lan est une lan uniqement dédiée a league of legends', 90611, '2020-07-04', '2021-09-08' , id FROM states WHERE type LIKE 'enabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'Greenlan', 'Greenlan est une lan multigaming a ciel ouvert', 16854, '2020-08-30', '2021-05-05' , id FROM states WHERE type LIKE 'disabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'GameJam', 'La GameJam est un atelier de creation de JV qui propose également des LANS', 33124, '2021-12-31', '2022-04-03' , id FROM states WHERE type LIKE 'disabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'HardGames', 'HardGames est une LAN composée uniquement de jeu tres difficiles', 44663, '2021-09-04', '2022-06-09' , id FROM states WHERE type LIKE 'enabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'SpeedLAN', 'La speedLAN est organisée par speedrun.com est a pour but de montrer des speedrun de multiples jeux', 26622, '2021-01-20', '2022-08-05' , id FROM states WHERE type LIKE 'enabled';
INSERT INTO lans ( name, description, places, start, end, state_id) SELECT  'FPS_LAN', 'FPS_LAN est une lan proposant uniquements des jeux tir', 35051, '2020-08-15', '2021-04-10' , id FROM states WHERE type LIKE 'disabled';

-- -----------------------------------------------------
-- Roles data
-- -----------------------------------------------------

INSERT INTO roles ( name, description) values ( 'moderator', 'Website moderator');
INSERT INTO roles ( name, description) values ( 'user', 'default user');

-- -----------------------------------------------------
-- Users data
-- -----------------------------------------------------

INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Pedro', 'Pinto', 'Pedro.PINTO@cpnv.ch', 'Django', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.', id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Yoann', 'Bonzon', 'Yoann.BONZON@cpnv.ch', 'Yoann', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Kenan', 'Augsburger', 'Kenan.AUGSBURGER@cpnv.ch', 'Mon', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Xavier', 'Carrel', 'Xavier.CARREL@cpnv.ch', 'Xavier', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Andre', 'Mpttier', 'Andre.MOTTIER@cpnv.ch', 'Andre', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'user';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Anastasia', 'Balsom', 'abalsom5@cpanel.net', 'abalsom5', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Boonie', 'Ayer', 'bayer6@baidu.com', 'bayer6', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Gearalt', 'Fessby', 'gfessby7@ustream.tv', 'gfessby7', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Prue', 'Collington', 'pcollington8@engadget.com', 'pcollington8', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'user';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Hildegaard', 'Harner', 'hharner9@myspace.com', 'hharner9', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'moderator';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Elliott', 'Neeve', 'eneeve0@furl.net', 'eneeve0', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'user';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Herman', 'Dodson', 'hdodson1@tiny.cc', 'hdodson1', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'user';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Laura', 'Earsman', 'learsman2@google.fr', 'learsman2', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'user';
INSERT INTO users ( firstname, lastname, email, username, Password, role_id) SELECT 'Bob', 'Ross', 'bob.ross@cpnv.ch', 'bobby', '$2y$10$gOj1W759Igxk9oln3q5mYOM4EBujsUJxrde8.h62dXF9y2Q2pXan.' , id FROM roles WHERE name LIKE 'user';

-- -----------------------------------------------------
-- Teams data
-- -----------------------------------------------------

INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Flowdesk', 'FDK' , id FROM users WHERE username LIKE 'eneeve0';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Zontrax', 'ZTX' , id FROM users WHERE username LIKE 'Django';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Fnatic', 'FNC' , id FROM users WHERE username LIKE 'abalsom5';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'SKT1', 'SKT1' , id FROM users WHERE username LIKE 'Mon';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Flexity', 'FXY' , id FROM users WHERE username LIKE 'learsman2';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Fusion', 'FON' , id FROM users WHERE username LIKE 'bayer6';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Gear2', 'G2' , id FROM users WHERE username LIKE 'Yoann';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'underrated', 'UND' , id FROM users WHERE username LIKE 'gfessby7';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Team solo mid', 'TSM' , id FROM users WHERE username LIKE 'learsman2';
INSERT INTO teams ( name, abbreviation, owner_id) SELECT 'Cloud9', 'C9' , id FROM users WHERE username LIKE 'Mon';


-- -----------------------------------------------------
-- Tournaments data
-- -----------------------------------------------------

INSERT INTO tournaments ( game, max_teams, name) values ( 'League Of Legents et CS GO', 300, 'Fight 4 Fun');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Overwatch', 60, 'Overwatch league');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Hearthstone', 300, 'Grand Masters Hearthstone');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Rocket League', 400, 'RLWC');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Rocket League et Rainbow-Six', 180, 'Rainbow Rockets');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Rainbow-Six, CS GO, APEX et CALL OF DUTY', 20, 'Pro Shooters');
INSERT INTO tournaments ( game, max_teams, name) values ( 'APEX et Fortnite', 100, 'Battle Royanl');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Heartstone et YU-GI-OH', 300, 'Card games tournament');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Mario cart', 340, 'Mario Racers');
INSERT INTO tournaments ( game, max_teams, name) values ( 'Need For Speed', 150, 'Faster than light');

-- -----------------------------------------------------
-- Matches data
-- -----------------------------------------------------

INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2020-11-09', '2020-06-23', 1, 3, 2, 1, 2, 1);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2021-12-23', '2021-06-05', 2, 3, 1, 3, 4, 1);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2021-12-22', '2020-05-13', 3, 0, 3, 3, 1, 1);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2021-12-26', '2021-02-04', 4, 23, 27, 5, 7, 8);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ('2020-12-08', '2021-04-13', 5, 27, 18, 6, 8, 8);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2021-09-07', '2020-07-09', 6, 16, 39, 7, 6, 8);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2020-06-27', '2020-06-16', 7, 31, 34, 9, 10, 5);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ('2020-08-27', '2021-04-01', 8, 35, 37, 1, 4, 5);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2020-10-24', '2020-08-05', 9, 74, 20, 10, 4, 5);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2020-09-18', '2021-03-16', 10, 8, 10, 3, 11, 9);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2020-09-18', '2021-03-16', 11, 8, 9, 6, 9, 9);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '2020-09-18', '2021-03-16', 12, 10, 8, 11, 9, 9);





