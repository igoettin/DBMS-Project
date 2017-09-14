/*
    This file contains debugging insertions to check the constraints on each table. 
*/

/*Debugging insertions used to check constraints for Player */
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1015, 225, 'CameronChinena', 'pass', '2017-03-21', 'Garcia', 'cchinena@nmsu.edu', 8793931011, 'ocean man');
insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos)
values(1016, 226, null, 'pass', '2017-03-21', 'Garcia', 's@nmsu.edu', 8793931011, 'center');

/*Debugging insertions to check the constraints for Game table*/
insert into Game(GameID,Date,Result,PlayingVenue,OpponentTeam)
values(005,'2017-09-08','Tie','The Pit','Aggies');
