insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1010, 220, 'Sebastian', 'pass', '1993-12-01', 'Garcia', 'skeed44@nmsu.edu', 911, 'shooting guard');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1011, 221, 'Thomas', 'pass1', '1991-11-11', 'Orange Street', 'tom192@nmsu.edu', 9105112345, 'small forward');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1012, 222, 'Jon', 'pass2', '1993-08-04', 'Blue Street', 'jon192781@nmsu.edu', 9102546577, 'point guard');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1013, 223, 'Bob', 'pass3', '1993-01-14', 'Green Ave', 'bob2121@nmsu.edu', 7834758676, 'power forward');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1014, 224, 'Derek', 'pass4', '1983-03-01', 'Red Street', 'derek2982@nmsu.edu', 8793921011, 'center');


insert into Manager(ID,LoginID,Name,Password,Birthday,Address,Email,PhoneNumber)
values(10, 20, 'Ryan', 'passw', '1994-11-05', 'Farm',  'ryan121@nmsu.edu', 4112345467);
insert into Manager(ID,LoginID,Name,Password,Birthday,Address,Email,PhoneNumber)
values(11, 21, 'Suzan', 'passw1', '1992-10-05', 'City',  'suzan981@nmsu.edu', 4232345467);
insert into Manager(ID,LoginID,Name,Password,Birthday,Address,Email,PhoneNumber)
values(12, 22, 'Bill', 'passw2', '1991-09-01', 'Country',  'bill25@nmsu.edu', 7112115467);
insert into Manager(ID,LoginID,Name,Password,Birthday,Address,Email,PhoneNumber)
values(13, 23, 'Zoey', 'passw3', '1984-04-02', 'City',  'zoey123@nmsu.edu', 4112345467);
insert into Manager(ID,LoginID,Name,Password,Birthday,Address,Email,PhoneNumber)
values(14, 24, 'Louis', 'passw4', '1968-10-05', 'Place',  'louis121@nmsu.edu', 4112345467);

insert into Staff(ID,Name,Birthday,Address,Email,PhoneNumber,Title)
values(30, 'Chris', '1994-01-09', 'Maine', 'chris21@gmail.com', 1018796758, 'Treasurer');
insert into Staff(ID,Name,Birthday,Address,Email,PhoneNumber,Title)
values(31, 'Debby', '1991-02-09', 'Florida', 'deb21@gmail.com', 1018349675, 'Secretary');
insert into Staff(ID,Name,Birthday,Address,Email,PhoneNumber,Title)
values(32, 'Max', '1991-03-09', 'Texas', 'max212@gmail.com', 1018796751, 'Health Advisor');
insert into Staff(ID,Name,Birthday,Address,Email,PhoneNumber,Title)
values(33, 'Ashley', '1990-01-02', 'New Mexico', 'ashle21@gmail.com', 1018726758, 'Water Girl');
insert into Staff(ID,Name,Birthday,Address,Email,PhoneNumber,Title)
values(34, 'Zack', '1984-02-09', 'North Carolina', 'zacl21@gmail.com', 1018791758, 'Coach');


insert into ManagerCertificate(ManagerID,CertificateID,Certificate)
values(10,40,NULL);
insert into ManagerCertificate(ManagerID,CertificateID,Certificate)
values(11,41,NULL);
insert into ManagerCertificate(ManagerID,CertificateID,Certificate)
values(12,42,NULL);
insert into ManagerCertificate(ManagerID,CertificateID,Certificate)
values(13,43,NULL);
insert into ManagerCertificate(ManagerID,CertificateID,Certificate)
values(14,44,NULL);

insert into Stats(PlayerID,Year,TotalPoints,ASPG)
values(1010,2017,10,15);
insert into Stats(PlayerID,Year,TotalPoints,ASPG)
values(1011,2017,20,30);
insert into Stats(PlayerID,Year,TotalPoints,ASPG)
values(1012,2017,30,45);
insert into Stats(PlayerID,Year,TotalPoints,ASPG)
values(1013,2017,50,60);
insert into Stats(PlayerID,Year,TotalPoints,ASPG)
values(1014,2017,60,75);

insert into Training(TrainingName, Instruction,TimePeriodInHour)
values('Running','Run 20 miles around the circuit', 8);
insert into Training(TrainingName, Instruction,TimePeriodInHour)
values('Lifting','Lift 80 pounds 100 times',4);
insert into Training(TrainingName, Instruction,TimePeriodInHour)
values('Practice','Practice free throws',7);
insert into Training(TrainingName, Instruction,TimePeriodInHour)
values('Sleep','Power sleep',1);
insert into Training(TrainingName, Instruction,TimePeriodInHour)
values('Database','Write queries',1);

insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1010,10,'Lifting');
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1011,11,'Lifting');
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1012,12,'Sleep');
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1013,13,'Running');
insert into AssignTraining(PlayerID,ManagerID,TrainingName)
values(1014,14,'Practice');

insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(001,'2017-09-08','Lose','Behind Corbett','Lakers');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(002,'2017-09-08','Lose','Activity Center','Aggies');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(003,'2017-09-08','Win','The Pit','The Jets');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(004,'2017-09-08','Tie','Behind Corbett','The Jets');
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(005,'2017-09-08','Tie','The Pit','Aggies');

insert into Play(PlayerID,GameID)
values(1010,001);
insert into Play(PlayerID,GameID)
values(1011,001);
insert into Play(PlayerID,GameID)
values(1012,002);
insert into Play(PlayerID,GameID)
values(1013,003);
insert into Play(PlayerID,GameID)
values(1014,004);

