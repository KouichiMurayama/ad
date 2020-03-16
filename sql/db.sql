/*
必要なテーブル
広告テーブル
サイトテーブル( EC and AS)
提携テーブル（広告ーサイト）
*/
/* AD Table
OID
PID 広告スペース
SID サイトID
NAME 広告名?
URL 広告URL
IMG 広告画像
*/

DROP TABLE AD_SPACE;
DROP TABLE AD;
DROP TABLE EC_SITE;
DROP TABLE AFFIL_SITE;

CREATE TABLE EC_SITE (
    OID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ACTIVE_FLAG CHAR(1),
    SITE_NAME VARCHAR(200),
    SITE_URL CHAR(200),
    INS_DATE DATE,
    UPD_DATE DATE
)AUTO_INCREMENT = 100;
INSERT INTO EC_SITE VALUES (null, 'Y', 'testEC100', 'aa', now(), now());
INSERT INTO EC_SITE VALUES (null, 'Y', 'testEC101', 'test130.com', now(), now());

CREATE TABLE AFFIL_SITE (
    OID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ACTIVE_FLAG CHAR(1),
    SITE_NAME VARCHAR(200),
    SITE_URL CHAR(200),
    INS_DATE DATE,
    UPD_DATE DATE
)AUTO_INCREMENT = 200;
INSERT INTO AFFIL_SITE VALUES (null, 'Y', 'testAS200', 'test456as', now(), now());
INSERT INTO AFFIL_SITE VALUES (null, 'Y', 'testAS201', 'test500as', now(), now());

CREATE TABLE AD(
    OID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ACTIVE_FLAG CHAR(1),
    ECID INT,
    NAME VARCHAR(20),
    URL VARCHAR(200),
    IMG_NAME VARCHAR(200),
    EXTENSION VARCHAR(10),
    IMG_DATA LONGBLOB NOT NULL,
    INS_DATE DATE,
    UPD_DATE DATE,
    FOREIGN KEY (ECID) REFERENCES EC_SITE(OID)
)AUTO_INCREMENT = 300;


CREATE TABLE AD_SPACE (
    OID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ACTICVE_FLAG CHAR(1),
    ADID INT,
    ASID INT,
    INS_DATE DATE,
    UPD_DATE DATE,
    FOREIGN KEY (ADID) REFERENCES AD(OID),
    FOREIGN KEY (ASID) REFERENCES AFFIL_SITE(OID)
)AUTO_INCREMENT = 400;

-- INSERT INTO AD VALUES(null,'Y',100,'Adsample300', 'URLsample1', 'sampleImgName', "jpg", null, now(), now());
-- INSERT INTO AD VALUES(null,'Y',101,'Adsample301', 'URLsample2', 'sampleImg02', now(), now());
-- INSERT INTO AD_SPACE VALUES(null, 'Y', 300, 200, now(), now());
-- INSERT INTO AD_SPACE VALUES(null, 'Y', 301, 201, now(), now());