/*
    This file contains debugging insertions to check the constraints on each table. 
    NOTE: You must source CreateDB.sql AND DataDB.sql for these test insertions to work properly.
*/



select 'Running debug tests for Player table...' as '';
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values('test', 225, 'Cameron', 'pass', '2017-03-21', 'Garcia', 'cchin@nmsu.edu', 8793931011, 'shooting guard');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1015, 225, 'Cameron', 'pass', '2017-03-21', 'Garcia', 'cchin@nmsu.edu', 8793931011, 'ocean man');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1016, 226, null, 'pass', '2017-03-21', 'Garcia', 's@nmsu.edu', 8793931011, 'center');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1017, 227, 'Tom', 'pass', '0170321', 'Garcia', 's@nmsu.edu', 8793931011, 'center');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1018, 228, 'Tom', 'pass', '2017-03-21', 'Garcia2', 's@nmsu.edu', 78793931011, 'center');


select 'Running debug tests for Manager table...' as '';
insert into Manager(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber)
values(20011, null, 'Jerry', 'pass', '2017-03-01', 'Garcia', 's@nmsu.edu', '8319782011');
insert into Manager(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber)
values(20012, 3011, null, 'pass', '2017-03-01', 'Garcia', 's@nmsu.edu', '8319782011');
insert into Manager(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber)
values(20013, 3011, 'Jerry', 'pass11111', '2017-03-01', 'Garcia', 's@nmsu.edu', '8319782011');
insert into Manager(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber)
values(20014, 3011, 'Jerry', 'pass', '32017-03-01', 'Garcia', 's@nmsu.edu', '8319782011');
insert into Manager(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber)
values(20015, 3011, 'Jerry', 'pass', '2017-03-01', 'Garcia', 's@nmsu.edu', '81111111111');

select 'Running debug tests for Staff table...' as '';
insert into Staff(ID, Name, Birthday, Address, Email, PhoneNumber, Title)
values(3001, null, '2017-03-01', 'Garcia', 's@nmsu.edu', '5890988901', 'ocean man');
insert into Staff(ID, Name, Birthday, Address, Email, PhoneNumber, Title)
values(3002, 'Jerry', '2017-03-01', 'Garcia', 's@nmsu.edu', '5890988901', null);

select 'Running debug tests for ManagerCertificate table...' as '';
insert into ManagerCertificate(ManagerID, CertificateId, Certificate)
values(9001, 31, null);

select 'Running debug tests for Stats...' as '';
insert into Stats(PlayerID, Year, TotalPoints, ASPG)
values(4001, '6532', 2, 2);
insert into Stats(PlayerID, Year, TotalPoints, ASPG)
values(1014, '65322', 2, 2);
insert into Stats(PlayerID, Year, TotalPoints, ASPG)
values(1014, '6532', -2, 2);
insert into Stats(PlayerID, Year, TotalPoints, ASPG)
values(1014, '6532', 2, -2);

select 'Running debug tests for Training...' as '';
insert into Training(TrainingName, Instruction, TimePeriodInHour)
values('car', null, 1313);
insert into Training(TrainingName, Instruction, TimePeriodInHour)
values('car', 'car', null);

select 'Running debug tests for Assign Training...' as '';
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(2001, 10, 'Running');
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1010, 32, 'Running');
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1010, 10, 'Bad');


select 'Running debug tests for Game table...' as '';
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(006,'2017-09-08','Bad','The Pit','Aggies');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(006,null,'Tie','The Pit','Aggies');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(006,'2017-09-08','Tie',null,'Aggies');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(006,'2017-09-08','Tie','The Pit',null);
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(006,'2017-09-08',null,'The Pit','Aggies');
