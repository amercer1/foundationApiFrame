CREATE DATABASE IF NOT EXISTS foundationApiFrame; 
go
USE foundationApiFrame; 

CREATE TABLE IF NOT EXISTS `jobinformation` (
  `username` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`job` INTEGER NOT NULL,
	`status` varchar(255) NOT NULL,
	CONSTRAINT pk_job PRIMARY KEY (username,job)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobinformation`
--

INSERT INTO jobinformation  VALUES("amercer","firstSecondLaunchedEver", 3486, "FINISHED");
INSERT INTO jobinformation  VALUES("amercer","firstJobLaunchedEver", 1286, "FINISHED");

