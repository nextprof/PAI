INSERT INTO public.exercises (id, title, score, with_load)
VALUES (5, 'Triceps bar', 3, true);
INSERT INTO public.exercises (id, title, score, with_load)
VALUES (4, 'Bench press', 4, true);
INSERT INTO public.exercises (id, title, score, with_load)
VALUES (2, 'Push-ups', 2, false);
INSERT INTO public.exercises (id, title, score, with_load)
VALUES (1, 'Scissors', 1, false);
INSERT INTO public.exercises (id, title, score, with_load)
VALUES (3, 'Deadlift', 5, true);
INSERT INTO public.exercises (id, title, score, with_load)
VALUES (6, 'Curl bar', 3, true);

/* all passwords are `test` */

INSERT INTO public.users (id, username, email, password, image_url)
VALUES (3, 'william_walker', 'ww@domain.com', '$2y$10$JUe0JBNEZoIvi8UqwZ9WgO2BqdFmEZXhL1zzFBKyphHg3zmpuZ.K2',
        'https://images.unsplash.com/photo-1597586124394-fbd6ef244026?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=32&ixid=MnwxfDB8MXxyYW5kb218MHx8cGVyc29ufHx8fHx8MTY0MzUwMDIyOA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=32');
INSERT INTO public.users (id, username, email, password, image_url)
VALUES (1, 'john_doe', 'jd@domain.com', '$2y$10$JUe0JBNEZoIvi8UqwZ9WgO2BqdFmEZXhL1zzFBKyphHg3zmpuZ.K2',
        'https://images.unsplash.com/photo-1525550557089-27c1bfedd06c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=32&ixid=MnwxfDB8MXxyYW5kb218MHx8cGVyc29ufHx8fHx8MTY0MzUwMDI0Ng&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=32');
INSERT INTO public.users (id, username, email, password, image_url)
VALUES (4, 'nicolas_mitchell', 'nm@domain.com', '$2y$10$JUe0JBNEZoIvi8UqwZ9WgO2BqdFmEZXhL1zzFBKyphHg3zmpuZ.K2',
        'https://images.unsplash.com/photo-1525875975471-999f65706a10?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=32&ixid=MnwxfDB8MXxyYW5kb218MHx8cGVyc29ufHx8fHx8MTY0MzUwMDIyNA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=32');
INSERT INTO public.users (id, username, email, password, image_url)
VALUES (5, 'harrison_scott', 'hs@domain.com', '$2y$10$JUe0JBNEZoIvi8UqwZ9WgO2BqdFmEZXhL1zzFBKyphHg3zmpuZ.K2',
        'https://images.unsplash.com/photo-1544133782-b62779394064?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=32&ixid=MnwxfDB8MXxyYW5kb218MHx8Z3ltfHx8fHx8MTY0MzUwMDI5OQ&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=32');
INSERT INTO public.users (id, username, email, password, image_url)
VALUES (2, 'ewelina_vicans', 'ev@domain.com', '$2y$10$JUe0JBNEZoIvi8UqwZ9WgO2BqdFmEZXhL1zzFBKyphHg3zmpuZ.K2',
        'https://images.unsplash.com/photo-1596815064285-45ed8a9c0463?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=32&ixid=MnwxfDB8MXxyYW5kb218MHx8cGVyc29ufHx8fHx8MTY0MzUwMDI1Mw&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=32');
INSERT INTO public.users (id, username, email, password, image_url)
VALUES (6, 'nextprof', 'np@domain.com', '$2y$10$JUe0JBNEZoIvi8UqwZ9WgO2BqdFmEZXhL1zzFBKyphHg3zmpuZ.K2',
        'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=32&ixid=MnwxfDB8MXxyYW5kb218MHx8cGVyc29ufHx8fHx8MTY0MzUwMDIxNA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=32');

INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (2, 2, 3, 60, 50, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (3, 6, 2, 30, 30, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (4, 2, 5, 30, 75, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (7, 5, 1, 40, 25, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (8, 3, 3, 50, 25, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (9, 1, 2, 40, 50, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (12, 2, 4, 30, 80, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (13, 3, 1, 40, 35, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (14, 4, 3, 20, 25, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (17, 1, 6, 40, 30, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (18, 2, 4, 60, 75, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (19, 6, 1, 30, 80, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (21, 3, 2, 40, 25, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (22, 4, 5, 20, 25, '2022-01-30');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (24, 3, 4, 50, 30, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (16, 3, 5, 50, 50, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (15, 5, 2, 40, 25, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (1, 1, 1, 40, 25, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (5, 3, 6, 40, 80, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (6, 4, 4, 20, 35, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (20, 2, 3, 30, 35, '2022-01-29');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (23, 5, 6, 40, 50, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (10, 2, 5, 60, 30, '2022-01-28');
INSERT INTO public.exercises_records (id, user_id, exercise_id, repeats, weight, time)
VALUES (11, 6, 6, 30, 75, '2022-01-28');


