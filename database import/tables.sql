
CREATE TABLE wlv_users(id integer AUTO_INCREMENT,PRIMARY KEY(id),
                      username varchar(255) NOT NULL,
                       `admin` tinyint DEFAULT 0,
                       `password` TEXT NOT NULL,                       
               `createdAT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                      );

CREATE TABLE wlv_topic(id integer AUTO_INCREMENT,PRIMARY KEY(id),
                       `name` varchar(255)
                       
                       ,
                       
                  `createdAT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                      );


CREATE TABLE wlv_blogs (id integer AUTO_INCREMENT,PRIMARY KEY(id),
                   `title` varchar(255),
                   `author` varchar(255),
                   `content` TEXT,
                   `published` VARCHAR(1) DEFAULT 0,
                   
                   `topicId` integer NOT NULL,
                        FOREIGN KEY(topicId) REFERENCES wlv_topic(id)
                        ON UPDATE CASCADE
                        ON DELETE CASCADE
                        ,
                    
                   `userId` integer NOT NULL,
                        FOREIGN KEY (userId) REFERENCES wlv_users(id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
                        ,
                        
                `createdAT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                        
                   );


CREATE TABLE wlv_likes(id integer AUTO_INCREMENT,PRIMARY KEY(id),
                      
                       `val` int DEFAULT 0,
                       
                       `userId` integer NOT NULL,
                       FOREIGN KEY (userId) REFERENCES wlv_users(id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE
                       ,
                       
                       `blogId` integer NOT NULL,
                       FOREIGN KEY (blogId) REFERENCES wlv_blogs(id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE
                       
                       ,
                       `parent` varchar(16000) DEFAULT NULL,
                
                       `createdAT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                       
                      
                      );



               
                      
	CREATE TABLE wlv_comments(id integer AUTO_INCREMENT,PRIMARY KEY(id),
                             
                     `comment` TEXT,      
                      `userId` integer NOT NULL,
                      FOREIGN KEY (userId) REFERENCES wlv_users(id)
                              ON DELETE CASCADE
                              ON UPDATE CASCADE
                              ,
                       `blogId` integer NOT NULL,
                       FOREIGN KEY (blogId) REFERENCES wlv_blogs(id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE       
                              
                              ,
                         `parent` varchar(16000) DEFAULT NULL,

                       
                      `createdAT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                              
                             
                             );                      



       CREATE TABLE wlv_likes_comments(id integer AUTO_INCREMENT,PRIMARY KEY(id),
                      
                       `val` int DEFAULT 0,
                       
                       `userId` integer NOT NULL,
                       FOREIGN KEY (userId) REFERENCES wlv_users(id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE
                       ,
                       
                       `commentId` integer NOT NULL,
                       FOREIGN KEY (commentId) REFERENCES wlv_comments(id)
                       ON DELETE CASCADE
                       ON UPDATE CASCADE,
                       
                       
                       `createdAT` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

                       
                      
                      );

