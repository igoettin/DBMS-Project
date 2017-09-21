drop database if exists cs482502fa17_igoettin;
create database cs482502fa17_igoettin;
use cs482502fa17_igoettin;

create table Player(
    ID		        int,
    LoginID	        varchar(16),
    Name	        varchar(64) not null,
    Password        varchar(8),
    Birthday        date,
    Address         varchar(128),
    Email           varchar(32),
    PhoneNumber     char(10),
    PlayPos         varchar(16),
    primary key(ID)
);

/* Trigger to check that PlayPos in Player table is the correct value */
delimiter //
create trigger player_pos_check before insert on Player
for each row
    begin
        if new.PlayPos != 'point guard' 
        and new.PlayPos != 'shooting guard' 
        and new.PlayPos != 'small forward' 
        and new.PlayPos != 'power forward' 
        and new.PlayPos != 'center' then
            signal sqlstate '45000' set message_text = 'ERROR: PlayPos must be point guard, shooting guard, small forward, power forward, or center!';
        end if;
    end
//
delimiter ;

create table Manager(
    ID	            int,
    LoginID	        varchar(16) not null,
    Name	        varchar(64) not null,
    Password	    varchar(8),
    Birthday	    date,
    Address	        varchar(128),
    Email	        varchar(32),
    PhoneNumber	    char(10),
    primary key(ID)
);

create table Staff(
    ID		        int,
    Name	        varchar(64) not null,
    Birthday	    date,
    Address	        varchar(128),
    Email	        varchar(32),
    PhoneNumber	    char(10),
    Title	        varchar(16) not null,
    primary key(ID)
);

create table ManagerCertificate(
    ManagerID	    int,
    CertificateId	int,
    Certificate		blob, 
    primary key(ManagerID,CertificateId),
    foreign key(managerID) references Manager(ID)
);

create table Stats(
    PlayerID	    int,
    Year	        char(4),
    TotalPoints	    int unsigned,
    ASPG	        int unsigned,
    primary key(PlayerID,Year),
    foreign key(PlayerID) references Player(ID)
);

create table Training(
    TrainingName	    varchar(16),
    Instruction		    varchar(256) not null,
    TimePeriodInHour	int not null,
    primary key(TrainingName)
);

create table AssignTraining(
    PlayerID	        int,
    ManagerID	        int,
    TrainingName        varchar(16),
    primary key(PlayerID, ManagerID, TrainingName),
    foreign key(PlayerID) references Player(ID),
    foreign key(ManagerID) references Manager(ID),
    foreign key(TrainingName) references Training(TrainingName)
);

create table Game(
    GameID	        int,
    Date	        date not null,
    Result	        varchar(16) not null,
    PlayingVenue	varchar(256) not null,
    OpponentTeam	varchar(32) not null,
    primary key(GameID)
);

/*Trigger to check the Game constraint of Win, Lose, or Tie */
delimiter //
create trigger game_check before insert on Game
for each row
    begin
        if new.Result != 'Win' 
        and new.Result != 'Lose' 
        and new.Result != 'Tie' then 
            signal sqlstate '45000' set message_text = 'ERROR: Result must be Win, Lose, or Tie!';
        end if;
    end
//
delimiter ;


create table Play(
    PlayerID	int,
    GameID		int,
    primary key(PlayerID, GameID),
    foreign key(PlayerID) references Player(ID),
    foreign key(GameID) references Game(GameID)
);
