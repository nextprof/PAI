create table users
(
    id serial
        constraint users_pk
            primary key,
    username varchar(100),
    email varchar(200),
    password varchar(255),
    image_url varchar(255) generated always as (('https://eu.ui-avatars.com/api/?size=32&name='::text || (username)::text)) stored
);

alter table users owner to testuser;

create unique index users_email_uindex
    on users (email);

create unique index users_username_uindex
    on users (username);

create table exercises
(
    id serial
        constraint exercises_pk
            primary key,
    title varchar not null,
    score integer,
    with_load boolean default false
);

alter table exercises owner to testuser;

create unique index exercises_title_uindex
    on exercises (title);

create table messages
(
    id serial
        constraint messages_pk
            primary key,
    id_from integer
        constraint messages_users_id_fk_from
            references users,
    id_to integer
        constraint messages_users_id_fk_to
            references users,
    message varchar
);

alter table messages owner to testuser;

create table exercises_records
(
    id serial
        constraint exercises_records_pk
            primary key,
    user_id integer not null
        constraint exercises_records_users_id_fk
            references users,
    exercise_id integer not null
        constraint exercises_records_exercises_id_fk
            references exercises,
    repeats integer default 0,
    weight double precision default 0,
    time date default CURRENT_DATE
);

alter table exercises_records owner to testuser;

create view v_user_scores(user_id, exercise_id, time, total_score) as
SELECT exercises_records.user_id,
       exercises_records.exercise_id,
       exercises_records."time",
       CASE e.with_load
           WHEN true THEN
                       (exercises_records.repeats * e.score / 10)::double precision * sqrt(exercises_records.weight) +
                       sqrt(exercises_records.weight)
           ELSE (exercises_records.repeats * e.score)::double precision
           END AS total_score
FROM exercises_records
         JOIN exercises e ON exercises_records.exercise_id = e.id;

alter table v_user_scores
    owner to testuser;

create view v_user_scores_daily(user_id, sum_day, score_day) as
SELECT v_user_scores.user_id,
       v_user_scores."time"           AS sum_day,
       sum(v_user_scores.total_score) AS score_day
FROM v_user_scores
GROUP BY v_user_scores.user_id, v_user_scores."time";

alter table v_user_scores_daily
    owner to testuser;

create view v_user_scores_monthly(user_id, time, sum_month) as
SELECT v_user_scores.user_id,
       date_trunc('month'::text, v_user_scores."time"::timestamp with time zone) AS "time",
       sum(v_user_scores.total_score)                                            AS sum_month
FROM v_user_scores
GROUP BY v_user_scores.user_id, (date_trunc('month'::text, v_user_scores."time"::timestamp with time zone));

alter table v_user_scores_monthly
    owner to testuser;

create function v_user_contact_list(integer)
    returns TABLE(user_id integer, user_name character varying)
    language sql
as
$$
select users.id, users.username
from (SELECT id_from as id
      from messages
      where id_to = $1
      union
      select id_to as id
      from messages
      where id_from = $1) messages
         join users on users.id = messages.id;
$$;

alter function v_user_contact_list(integer) owner to testuser;
