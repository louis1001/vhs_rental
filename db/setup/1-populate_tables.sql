INSERT INTO
    topicos
    (nombre)
VALUES
    ('Comedia'), ('Drama'), ('Terror'), ('Acción'), ('Ciencia Ficción'),
    ('Fantasía'), ('Documental'), ('Animación'), ('Musical'), ('Romance');

INSERT INTO
    peliculas
    (titulo, topico_id, anio, resumen, disponible )
VALUES
    ('The Hangover', 1, 2009, 'Three buddies wake up from a bachelor party in Las Vegas, with no memory of the previous night and the bachelor missing. They make their way around the city in order to find their friend before his wedding.', 1),
    ('The Godfather', 2, 1972, 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 1),
    ('The Shining', 3, 1980, 'A family heads to an isolated hotel for the winter where a sinister presence influences the father into violence, while his psychic son sees horrific forebodings from both past and future.', 1),
    ('The Dark Knight', 4, 2008, 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 1),
    ('Inception', 5, 2010, 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.', 1),
    ('The Lord of the Rings: The Fellowship of the Ring', 6, 2001, 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', 1),
    ('The Social Dilemma', 7, 2020, 'Explores the dangerous human impact of social networking, with tech experts sounding the alarm on their own creations.', 1);

INSERT INTO
    clientes
    (nombre, apellido, telefono, correo)
VALUES
    ('John', 'Doe', '555-555-5555', 'example@email.com'),
    ('Jane', 'Doe', '555-555-5555', 'different@email.com');