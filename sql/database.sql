CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(150) NOT NULL,
    creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE jugadores_NBA (
    jugadores_NBA_id INT AUTO_INCREMENT PRIMARY KEY,
    cod_jugador VARCHAR(100) UNIQUE NOT NULL, 
    Nombre VARCHAR(50) NOT NULL,         
    Equipo VARCHAR(50) NOT NULL,       
    Dorsal VARCHAR(50) NOT NULL,
    Edad VARCHAR(100) NOT NULL
);
INSERT INTO jugadores_NBA (cod_jugador, Nombre, Equipo, Dorsal, Edad) VALUES
('LBJ23', 'LeBron James', 'Los Angeles Lakers', '23', '39'),
('SC30', 'Stephen Curry', 'Golden State Warriors', '30', '36'),
('KD7', 'Kevin Durant', 'Brooklyn Nets', '7', '34'),
('AD3', 'Anthony Davis', 'Los Angeles Lakers', '3', '31'),
('KL2', 'Kawhi Leonard', 'Los Angeles Clippers', '2', '32'),
('GA34', 'Giannis Antetokounmpo', 'Milwaukee Bucks', '34', '29'),
('LD77', 'Luka Doncic', 'Dallas Mavericks', '77', '25'),
('NJ15', 'Nikola Jokic', 'Denver Nuggets', '15', '32'),
('JE21', 'Joel Embiid', 'Philadelphia 76ers', '21', '30'),
('JT0', 'Jayson Tatum', 'Boston Celtics', '0', '27');
