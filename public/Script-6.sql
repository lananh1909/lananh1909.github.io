create table language_table (
	language_code VARCHAR(10) not null,
	language_name VARCHAR(60),
	constraint pk_language_code primary key(language_code)
);

insert into language_table (language_code, language_name) values
('eng', 'English'),
('en-US', 'English (United States)'),
('fre', 'French'),
('en-GB', 'English (United Kingdom)'),
('mul', 'Multiple Language'),
('spa', 'Spanish'),
('grc', 'Greek'),
('enm', 'English, Middle (1100-1500)'),
('en-CA', 'English (Canada)'),
('ger', 'German'),
('jpn', 'Japanese'),
('ara', 'Arabic'),
('nl', 'Dutch'),
('zho', 'Chinese'),
('lat', 'Latin'),
('por', 'Portuguese'),
('srp', 'Serbian'),
('ita', 'Italian'),
('rus', 'Russian'),
('msa', 'Malaysian'),
('glg', 'Galician'),
('swe', 'Swedish'),
('nor', 'Norwegian'),
('tur', 'Turkish'),
('gla', 'Scottish Gaelic'),
('ale', 'Aleut'),
('wel', 'Welsh');

select * from language_table;

create table book (
	book_id int not null,
	title VARCHAR(200),
	authors VARCHAR(200),
	rating double,
	language_code VARCHAR(10),
	num_page int,
	publication_date VARCHAR(20),
	publisher VARCHAR(200),
	constraint pk_book_id primary key(book_id),
	constraint fk_language_code foreign key (language_code) references language_table(language_code)
)

alter table book add column authors VARCHAR(400);
alter table book drop column title;
alter table book drop column authors;
alter table book modify publication_date date;

select count(book_id) from book;

delete from book;

insert into book (book_id, publication_date) values (11, '2020-11-20');
select * from book where year(publication_date)=2003;
select language_name from book natural join language_table;