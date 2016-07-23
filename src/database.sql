/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Ja
 * Created: 2016-07-08
 */
-- //zapytanie sql:

CREATE TABLE User(
    id INT AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(100),
    active TINYINT DEFAULT 1,
    PRIMARY KEY(id)
)


CREATE TABLE Tweet(
    id INT AUTO_INCREMENT,
    user_id INT NOT NULL,
    text VARCHAR(140) NOT NULL, 
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES User (id)
)

CREATE TABLE Comment(
    id INT AUTO_INCREMENT,
    user_id INT NOT NULL,
    tweet_id INT NOT NULL,
    creation_date DATETIME NOT NULL,
    text TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES User (id),
    FOREIGN KEY (tweet_id) REFERENCES Tweet (id)
)

CREATE TABLE Message(
    id INT AUTO_INCREMENT,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message_text TEXT NOT NULL,
    creation_date DATETIME NOT NULL,
    is_read TINYINT DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (sender_id) REFERENCES User(id),
    FOREIGN KEY (receiver_id) REFERENCES User(id)
)


-- is_read - pole trzymajace informacje
--  czy wiadomosc zsostala przeczytana

-- 
-- user_id snake Case


SELECT * FROM Tweet WHERE user_id=14;

INSERT INTO Tweet (user_id, text) VALUES (14, 'tweet2');


-- backup bazy danych, komenda tworzac plik prztrzeymujace pelny zapis bazy:
-- mysqldump -u [user_name] -p [database_name] > [file].sql
--     


UPDATE Comment SET 
user_id=14, tweet_id=1, creation_date=NOW(), text='komentarz' 
WHERE id=1;

INSERT INTO Comment 
(user_id, tweet_id, creation_date, text)
 VALUES (14, 3, NOW(), 'komentarz');

SELECT * FROM Comment WHERE Comment.tweet_id=1;


SELECT * FROM Comment 
WHERE Comment.user_id=14 AND Comment.tweet_id=1
ORDER BY Comment.creation_date DESC;