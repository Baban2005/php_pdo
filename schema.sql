CREATE TABLE rock_bands (
    band_id INT PRIMARY KEY,
    band_name VARCHAR(100) NOT NULL,
    genre VARCHAR(50),
    formed_year INT
);

CREATE TABLE venues (
    venue_id INT PRIMARY KEY,
    venue_name VARCHAR(100) NOT NULL,
    city VARCHAR(100),
    country VARCHAR(100),
    max_capacity INT
);

CREATE TABLE rock_concert_attendances (
    concert_id INT PRIMARY KEY,
    band_id INT,
    venue_id INT,
    concert_date DATE,
    general_tickets_sold INT,
    vip_tickets_sold INT,
    ticket_price_general DECIMAL(10, 2),
    ticket_price_vip DECIMAL(10, 2),
    FOREIGN KEY (band_id) REFERENCES rock_bands(band_id),
    FOREIGN KEY (venue_id) REFERENCES venues(venue_id)
);

-- Insert Bands
INSERT INTO rock_bands (band_id, band_name, genre, formed_year) VALUES
(1, 'The Rolling Stones', 'Classic Rock', 1962),
(2, 'Arctic Monkeys', 'Indie Rock', 2002),
(3, 'Foo Fighters', 'Alternative Rock', 1994),
(4, 'Metallica', 'Heavy Metal', 1981),
(5, 'Queen', 'Classic Rock', 1970);

-- Insert Venues
INSERT INTO venues (venue_id, venue_name, city, country, max_capacity) VALUES
(101, 'Wembley Stadium', 'London', 'UK', 90000),
(102, 'Madison Square Garden', 'New York', 'USA', 20789),
(103, 'Tokyo Dome', 'Tokyo', 'Japan', 55000),
(104, 'Olympiastadion', 'Berlin', 'Germany', 74475),
(105, 'Estádio do Maracanã', 'Rio de Janeiro', 'Brazil', 78838);

-- Insert Attendance Records
INSERT INTO rock_concert_attendances (concert_id, band_id, venue_id, concert_date, general_tickets_sold, vip_tickets_sold, ticket_price_general, ticket_price_vip) VALUES
(1001, 1, 101, '2023-06-15', 75000, 5000, 150.00, 450.00),
(1002, 1, 105, '2023-08-20', 70000, 4500, 80.00, 250.00),
(1003, 2, 101, '2023-09-10', 80000, 8000, 100.00, 300.00),
(1004, 3, 102, '2023-11-05', 18000, 2000, 120.00, 350.00),
(1005, 4, 103, '2024-01-12', 50000, 4000, 130.00, 400.00),
(1006, 4, 104, '2024-03-22', 65000, 6000, 110.00, 350.00),
(1007, 3, 101, '2024-05-30', 82000, 7500, 115.00, 320.00),
(1008, 5, 101, '2024-07-14', 85000, 5000, 180.00, 500.00);
