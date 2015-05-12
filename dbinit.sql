CREATE DATABASE CAR_RENTAL;
USE CAR_RENTAL;
DROP TABLE IF EXISTS CAR;
CREATE TABLE CAR (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	COST FLOAT(10) NOT NULL,
	PRIMARY KEY (ID)
	);
DROP TABLE IF EXISTS PROPERTY;	
CREATE TABLE PROPERTY (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	DESCRIPTION VARCHAR(255) NOT NULL,
	PRIMARY KEY (ID)
	);
DROP TABLE IF EXISTS MODEL;
CREATE TABLE MODEL (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	MODEL VARCHAR(255) NOT NULL,
	PRIMARY KEY (ID)
	);
DROP TABLE IF EXISTS CAR_PROPERTY;
CREATE TABLE CAR_PROPERTY (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	CAR_ID INT(10) NOT NULL,
	PROPERTY_ID INT(10) NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (CAR_ID) REFERENCES CAR(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (PROPERTY_ID) REFERENCES PROPERTY(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT
	);
DROP TABLE IF EXISTS CLIENT;
CREATE TABLE CLIENT (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	FIRST_NAME VARCHAR(255) NOT NULL,
	LAST_NAME VARCHAR(255) NOT NULL,
	MIDDLE_NAME VARCHAR(255) NOT NULL,
	PASSPORT VARCHAR(255) NOT NULL,
	PHONE_NUMBER VARCHAR(12),
	DISCOUNT INT(2),
	PRIMARY KEY (ID)
	);
DROP TABLE IF EXISTS PREFERENCE;
CREATE TABLE PREFERENCE (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	START_DATE DATE NOT NULL,
	RENT_DURATION INT(3) NOT NULL,
	MAXIMAL_COST FLOAT(10),
	PRIMARY KEY (ID)
	);
DROP TABLE IF EXISTS PREFERENCE_PROPERTY;
CREATE TABLE PREFERENCE_PROPERTY (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	PREFERENCE_ID INT(10) NOT NULL,
	PROPERTY_ID INT(10) NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (PREFERENCE_ID) REFERENCES PREFERENCE(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (PROPERTY_ID) REFERENCES PROPERTY(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT
	);
DROP TABLE IF EXISTS CLIENT_PREFERENCE;
CREATE TABLE CLIENT_PREFERENCE (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	PREFERENCE_ID INT(10) NOT NULL,
	CLIENT_ID INT(10) NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (PREFERENCE_ID) REFERENCES PREFERENCE(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (CLIENT_ID) REFERENCES CLIENT(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE
	);
DROP TABLE IF EXISTS PREFERENCE_MODEL;
CREATE TABLE PREFERENCE_MODEL (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	PREFERENCE_ID INT(10) NOT NULL,
	MODEL_ID INT(10) NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (PREFERENCE_ID) REFERENCES PREFERENCE(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (MODEL_ID) REFERENCES MODEL(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT
	);

DROP TABLE IF EXISTS CAR_MODEL;
CREATE TABLE CAR_MODEL (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	CAR_ID INT(10) UNIQUE NOT NULL,
	MODEL_ID INT(10) NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (CAR_ID) REFERENCES CAR(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (MODEL_ID) REFERENCES MODEL(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT
	);
DROP TABLE IF EXISTS DEAL;
CREATE TABLE DEAL (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	CAR_ID INT(10) NOT NULL,
	CLIENT_ID INT(10) NOT NULL,
	PREFERENCE_ID INT(10) NOT NULL,
	START_DATE DATE NOT NULL,
	FINISH_DATE DATE NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (CAR_ID) REFERENCES CAR(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (CLIENT_ID) REFERENCES CLIENT(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT,
	FOREIGN KEY (PREFERENCE_ID) REFERENCES PREFERENCE(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT
	);
DROP TABLE IF EXISTS FINE;
CREATE TABLE FINE (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	FINE_TYPE INT(1),
	FINE_COST FLOAT(10) NOT NULL,
	PRIMARY KEY (ID)
);
DROP TABLE IF EXISTS PAYMENT;
CREATE TABLE PAYMENT (
	ID INT(10) AUTO_INCREMENT NOT NULL,
	DEAL_ID INT(10) NOT NULL,
	FINE_ID INT(10) NOT NULL,
	FINAL_COST FLOAT(10) NOT NULL,
	PRIMARY KEY (ID),
	FOREIGN KEY (DEAL_ID) REFERENCES DEAL(ID)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (FINE_ID) REFERENCES FINE(ID)
		ON UPDATE CASCADE
        ON DELETE RESTRICT
	);
INSERT INTO MODEL (MODEL)
VALUES
  ('TOYOTA AVENSIS'),
  ('TOYOTA CARINA'),
  ('TOYOTA CALDINA'),
  ('TOYOTA RAV4'),
  ('HONDA CIVIC'),
  ('HONDA ACCORD'),
  ('HONDA CR-V'),
  ('FORD FOCUS'),
  ('FORD KUGA'),
  ('FORD ESCAPE'),
  ('VOLKSWAGEN AMAROK'),
  ('MITSUBISHI LANCER'),
  ('OPEL ASTRA'),
  ('LADA KALINA'),
  ('LADA PRIORA'),
  ('HYUNDAI GETZ'),
  ('HYUNDAI TUCSON'),
  ('HYUNDAI SOLARIS'),
  ('CHEVROLET AVEO'),
  ('CHEVROLET COBALT'),
  ('CHEVROLET NIVA'),
  ('UAZ PATRIOT')
;
INSERT INTO PROPERTY (DESCRIPTION)
VALUES
  ('LEATHER INTERIOR'),
  ('ABS'),
  ('LEFT HAND DRIVE'),
  ('RIGHT HAND DRIVE'),
  ('TURBO'),
  ('FOG LIGHTS'),
  ('LED RUNNING LIGHTS'),
  ('4x4'),
  ('FRAME SUV');