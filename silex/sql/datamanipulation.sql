USE silex;

-- PREFILL YOUR TABLES HERE
INSERT INTO users (username, password, email, firstname, lastname) VALUES
('twittwer', MD5('bar123'), 't.wittwer95@gmail.com', 'Tobias', 'Wittwer'),
('oglaser', MD5('bar123'), 'olivia@e.mail', 'Olivia', 'Glaser'),
('pdarius', MD5('bar123'), 'paul@e.mail', 'Paul', 'Darius'),
('alonso', MD5('bar123'), 'alons-y@e.mail', NULL, NULL),
('thedoctor', MD5('tardis'), 'doctor@gallifrey.uni', 'John', 'Smith');

INSERT INTO blog_posts (title, text, user_id) VALUES
('The Saxon Switzerland', 'text', 1),
('The Bivvy', 'text', 1),
('Trekking in Czech', 'text', 1),
('Putins approval rating', 'text', 2),
('Israel turns off power', 'text', 2),
('NATO commander warns', 'text', 2),
('The traditional Yerba', 'text', 1),
('The childhood myth', 'text', 3),
('Online gaming and its risks', 'text', 3),
('Go blue planet', 'text', 3),
('Korean fried chicken wings', 'text', 4),
('Hannibal-themed dinner', 'text', 4),
('Homemade paella', 'text', 4),
('The concept of the time travel', 'text', 5),
('The Ood and their songs', 'text', 5),
('Tardis Type 40', 'text', 5),
('The Greate Gallifrey', 'text', 5);

UPDATE blog_posts SET text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br/>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.<br/>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br/><br/>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br/><br/>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.' WHERE text = 'text';