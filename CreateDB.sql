create table Player(
	ID			int,
    LoginID		varchar(16),
    Name		varchar(64) not null,
    Password	varchar(8),
    Birthday	date,
    Address     varchar(128),
    Email		varchar(32),
    PhoneNumber	char(10),
    PlayPos		varchar(16)
    check(PlayPos in ('point guard','shooting guard', 'small forward','power forward','center')),
	primary key(ID)
);

create table Manager(
	ID			int,
    LoginID		varchar(16) not null,
    Name		varchar(64) not null,
    Password	varchar(8),
    Birthday	date,
    Address		varchar(128),
    Email		varchar(32),
    PhoneNumber	char(10),
    primary key(ID)
);

create table Staff(
	ID			int,
    Name		varchar(64) not null,
    Birthday	date,
    Address		varchar(128),
    Email		varchar(32),
    PhoneNumber	char(10),
    Title		varchar(16) not null,
    primary key(ID)
);

create table ManagerCertificate(
	ManagerID		int,
    CertificateId	int,
    Certificate		blob, 
	primary key(ManagerID,CertificateId),
    foreign key(managerID) references Manager(ID)
);

create table Stats(
	PlayerID	int,
    Year		char(4),
    TotalPoints	int unsigned,
    ASPG		int unsigned,
    primary key(PlayerID,Year),
    foreign key(PlayerID) references Player(ID)
);

create table Training(
	TrainingName		varchar(16),
    Instruction			varchar(256) not null,
    TimePeriodInHour	int not null,
    primary key(TrainingName)
);

create table AssignTraining(
	PlayerID	int,
    ManagerID	int,
    TrainingName	varchar(16),
    primary key(PlayerID, ManagerID, TrainingName),
    foreign key(PlayerID) references Player(ID),
    foreign key(ManagerID) references Manager(ID),
    foreign key(TrainingName) references Training(TrainingName)
);

create table Game(
	GameID	int,
    Date	date not null,
    Result	varchar(16) not null,
    PlayingVenue	varchar(256) not null,
    OpponentTeam	varchar(32) not null,
    primary key(GameID),
    check (Result in ('Win', 'Lose', 'Tie'))
);

create table Play(
	PlayerID	int,
    GameID		int,
    primary key(PlayerID, GameID),
    foreign key(PlayerID) references Player(ID),
    foreign key(GameID) references Game(GameID)
);
