USE `elan`;

-- -----------------------------------------------------
-- Locations data
-- -----------------------------------------------------

INSERT INTO locations (id, Name, address) values (1, 'Bamity', '33664 Sachtjen Parkway');
INSERT INTO locations (id, Name, address) values (2, 'Toughjoyfax', '330 Transport Hill');
INSERT INTO locations (id, Name, address) values (3, 'Stronghold', '0 Warner Way');
INSERT INTO locations (id, Name, address) values (4, 'Holdlamis', '7 Novick Street');
INSERT INTO locations (id, Name, address) values (5, 'Bytecard', '55802 Sage Place');
INSERT INTO locations (id, Name, address) values (6, 'Span', '8 Mandrake Circle');
INSERT INTO locations (id, Name, address) values (7, 'Bytecard', '4 Elka Road');
INSERT INTO locations (id, Name, address) values (8, 'Sonsing', '200 Donald Street');
INSERT INTO locations (id, Name, address) values (9, 'Trippledex', '003 Merrick Alley');
INSERT INTO locations (id, Name, address) values (10, 'Bitchip', '6 John Wall Center');

-- -----------------------------------------------------
-- Events data
-- -----------------------------------------------------

INSERT INTO events (id, name, description, type, start, end) values (1, 'Vagram', 'Dyche', 'Quizz', '23.08.2020', '16.03.2022');
INSERT INTO events (id, name, description, type, start, end) values (2, 'Quo Lux', 'Olenchenko', 'Shop', '06.05.2020', '21.06.2021');
INSERT INTO events (id, name, description, type, start, end) values (3, 'It', 'Smorthwaite', 'other', '16.07.2020', '27.04.2022');
INSERT INTO events (id, name, description, type, start, end) values (4, 'Opela', 'Copyn', 'Tournement', '21.10.2021', '05.01.2021');
INSERT INTO events (id, name, description, type, start, end) values (5, 'Alpha', 'Zellick', 'Quizz', '27.10.2020', '20.05.2021');
INSERT INTO events (id, name, description, type, start, end) values (6, 'Konklux', 'Tomisch', 'other', '15.10.2021', '24.04.2022');
INSERT INTO events (id, name, description, type, start, end) values (7, 'Tin', 'Caseley', 'Shop', '06.06.2020', '03.05.2021');
INSERT INTO events (id, name, description, type, start, end) values (8, 'Solarbreeze', 'Auchterlony', 'other', '11.01.2021', '24.06.2021');
INSERT INTO events (id, name, description, type, start, end) values (9, 'Voyatouch', 'Bradburne', 'other', '20.02.2021', '26.04.2022');
INSERT INTO events (id, name, description, type, start, end) values (10, 'Subin', 'Batte', 'Shop', '22.04.2021', '20.09.2020');

-- -----------------------------------------------------
-- States data
-- -----------------------------------------------------

INSERT INTO states (id, type) values (1, 'enable');
INSERT INTO states (id, type) values (2, 'disable');

-- -----------------------------------------------------
-- Lans data
-- -----------------------------------------------------

INSERT INTO lans (id, name, description, places, start, end, state_id) values (1, 'Regrant', 'Revision of Autol Sub in R Knee Jt, Open Approach', 34984, '16.06.2020', '23.11.2021', 2);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (2, 'Bitwolf', 'Bypass L Atrium to L Pulm Vn w Synth Sub, Perc Endo', 59957, '03.02.2021', '15.06.2021', 1);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (3, 'Gembucket', 'Inspection of Right Hand, External Approach', 63359, '16.08.2021', '29.01.2021', 2);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (4, 'Bigtax', 'Fluency Treatment using Voice Analysis Equipment', 12615, '19.04.2021', '26.06.2020', 2);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (5, 'Sonsing', 'Insertion of Intramed Fix into L Ulna, Perc Endo Approach', 90611, '04.07.2020', '08.09.2021', 1);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (6, 'Greenlam', 'Bypass L Com Iliac Art to L Femor A w Synth Sub, Perc Endo', 16854, '30.08.2020', '05.05.2021', 2);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (7, 'Toughjoyfax', 'Revision of Ext Fix in R Metatarsotars Jt, Extern Approach', 33124, '31.12.2021', '03.04.2021', 2);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (8, 'Home Ing', 'Revise of Nonaut Sub in L Metatarsotars Jt, Extern Approach', 44663, '04.09.2021', '09.06.2021', 1);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (9, 'Y-Solowarm', 'Supplement Perineum Tendon with Nonaut Sub, Open Approach', 26622, '20.01.2021', '05.08.2020', 1);
INSERT INTO lans (id, name, description, places, start, end, state_id) values (10, 'Trippledex', 'Excision of Left Hepatic Duct, Open Approach', 35051, '15.08.2020', '10.04.2021', 2);

-- -----------------------------------------------------
-- Roles data
-- -----------------------------------------------------

INSERT INTO roles (id, name, description) values (1, 'moderator', 'Website moderator');
INSERT INTO roles (id, name, description) values (2, 'user', 'default user');

-- -----------------------------------------------------
-- Users data
-- -----------------------------------------------------

INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (1, 'Pedro', 'Pinto', 'Pedro.PINTO@cpnv.ch', 'Django', 'Pa$$w0rd', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (2, 'Yoann', 'Bonzon', 'Yoann.BONZON@cpnv.ch', 'Yoann', 'Pa$$w0rd', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (3, 'Kenan', 'Augsburger', 'Kenan.AUGSBURGER@cpnv.ch', 'Mon', 'Pa$$w0rd', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (4, 'Lancelot', 'Estrella', 'lestrella3@newyorker.com', 'lestrella3', 'y5yTZV5', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (5, 'Herbie', 'Perrelle', 'hperrelle4@soundcloud.com', 'hperrelle4', 'DHTGz7ag3mor', 2);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (6, 'Anastasia', 'Balsom', 'abalsom5@cpanel.net', 'abalsom5', 'SeyHG4JPzlmJ', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (7, 'Boonie', 'Ayer', 'bayer6@baidu.com', 'bayer6', 'SKh8VNEA', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (8, 'Gearalt', 'Fessby', 'gfessby7@ustream.tv', 'gfessby7', 'jVWICQi', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (9, 'Prue', 'Collington', 'pcollington8@engadget.com', 'pcollington8', '3PI6dvIbra', 2);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) values (10, 'Hildegaard', 'Harner', 'hharner9@myspace.com', 'hharner9', 'YC2ROf', 1);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) VALUES (11, 'Elliott', 'Neeve', 'eneeve0@furl.net', 'eneeve0', 'zVbMcyTu', 2);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) VALUES (12, 'Herman', 'Dodson', 'hdodson1@tiny.cc', 'hdodson1', 'hcMKY4k7nBHn', 2);
INSERT INTO users (id, firstname, lastname, email, username, Password, role_id) VALUES (13, 'Laura', 'Earsman', 'learsman2@google.fr', 'learsman2', 'RKXSXRBFD2jk', 2);

-- -----------------------------------------------------
-- Teams data
-- -----------------------------------------------------

INSERT INTO teams (id, name, abbreviation, owner_id) values (1, 'Flowdesk', 'FDK', 11);
INSERT INTO teams (id, name, abbreviation, owner_id) values (2, 'Zontrax', 'ZTX', 1);
INSERT INTO teams (id, name, abbreviation, owner_id) values (3, 'Fnatic', 'FNC', 6);
INSERT INTO teams (id, name, abbreviation, owner_id) values (4, 'Voltsillam', 'VSM', 3);
INSERT INTO teams (id, name, abbreviation, owner_id) values (5, 'Flexidy', 'FXY', 13);
INSERT INTO teams (id, name, abbreviation, owner_id) values (6, 'Cardguard', 'CGD', 7);
INSERT INTO teams (id, name, abbreviation, owner_id) values (7, 'Veribet', 'VBT', 2);
INSERT INTO teams (id, name, abbreviation, owner_id) values (8, 'Viva', 'Viva', 8);
INSERT INTO teams (id, name, abbreviation, owner_id) values (9, 'Home Ing', 'HI', 13);
INSERT INTO teams (id, name, abbreviation, owner_id) values (10, 'Tresomcorp', 'TCP' , 3);
INSERT INTO teams (id, name, abbreviation, owner_id) values (11, 'lafrenchcolection', 'LFC' , 2);

-- -----------------------------------------------------
-- Tournaments data
-- -----------------------------------------------------

INSERT INTO tournaments (id, game, max_teams, name) values (1, 'Zicam', 331, 'Y-Solowarm');
INSERT INTO tournaments (id, game, max_teams, name) values (2, 'Bryophyllum e fol. 10', 60, 'Domainer');
INSERT INTO tournaments (id, game, max_teams, name) values (3, 'Head and Shoulders', 310, 'Treeflex');
INSERT INTO tournaments (id, game, max_teams, name) values (4, 'ISA KNOX WXII PLUS WHITENING REVOLUTION SERUM', 392, 'Gembucket');
INSERT INTO tournaments (id, game, max_teams, name) values (5, 'Grains and Gluten Intolerances', 182, 'Greenlam');
INSERT INTO tournaments (id, game, max_teams, name) values (6, 'Coppertone Tanning Dry Oil', 29, 'Wrapsafe');
INSERT INTO tournaments (id, game, max_teams, name) values (7, 'Lotrel', 7, 'Zoolab');
INSERT INTO tournaments (id, game, max_teams, name) values (8, 'Prednisone', 318, 'Prodder');
INSERT INTO tournaments (id, game, max_teams, name) values (9, 'Goongsecret Calming Bath', 348, 'Glltournament');
INSERT INTO tournaments (id, game, max_teams, name) values (10, 'Oxygen', 155, 'Daltfresh');

-- -----------------------------------------------------
-- Matches data
-- -----------------------------------------------------

INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '09.11.2020', '23.06.2020', 1, 3, 2, 1, 2, 1);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '23.12.2021', '05.06.2021', 2, 3, 1, 3, 4, 1);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '22.12.2021', '13.05.2020', 3, 0, 3, 3, 1, 1);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '26.12.2021', '04.02.2021', 4, 23, 27, 5, 7, 8);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ('08.12.2020', '13.04.2021', 5, 27, 18, 6, 8, 8);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '07.09.2021', '09.07.2020', 6, 16, 39, 7, 6, 8);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '27.06.2020', '16.06.2020', 7, 31, 34, 9, 10, 5);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ('27.08.2020', '01.04.2021', 8, 35, 37, 1, 4, 5);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '24.10.2020', '05.08.2020', 9, 74, 20, 10, 4, 5);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '18.09.2020', '16.03.2021', 10, 8, 10, 3, 11, 9);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '18.09.2020', '16.03.2021', 11, 8, 9, 6, 9, 9);
INSERT INTO matches ( start, end, match_number, score_team1, score_team2, team1_id, team2_id, tournament_id) values ( '18.09.2020', '16.03.2021', 12, 10, 8, 11, 9, 9);

