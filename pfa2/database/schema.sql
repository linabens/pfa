
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- Store hashed passwords, never plain text!
    phone_number VARCHAR(20),
    needs_description TEXT,               -- Optional: User can describe specific needs
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE facilities (
    facility_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100),
    postal_code VARCHAR(20),
    latitude DECIMAL(10, 8),             -- For map integration
    longitude DECIMAL(11, 8),            -- For map integration
    phone_number VARCHAR(20),
    website VARCHAR(255)
    -- Add other relevant facility details if needed
);

CREATE TABLE accessibility_features (
    feature_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL, -- e.g., 'Ramp Access', 'Elevator', 'Accessible Restroom'
    description TEXT
);

-- Junction table to link facilities to their accessibility features (Many-to-Many)
CREATE TABLE facility_accessibility (
    facility_id INT,
    feature_id INT,
    PRIMARY KEY (facility_id, feature_id), -- Composite primary key
    FOREIGN KEY (facility_id) REFERENCES facilities(facility_id) ON DELETE CASCADE,
    FOREIGN KEY (feature_id) REFERENCES accessibility_features(feature_id) ON DELETE CASCADE
);

CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    specialty VARCHAR(100),              -- e.g., 'General Practitioner', 'Cardiologist'
    email VARCHAR(100) UNIQUE,           -- Optional contact
    phone_number VARCHAR(20),            -- Optional contact
    profile_description TEXT,
    facility_id INT,                     -- Link doctor to a primary facility (One-to-Many)
    FOREIGN KEY (facility_id) REFERENCES facilities(facility_id) ON DELETE SET NULL -- Or CASCADE depending on requirements
    -- Consider if doctors can work at multiple facilities - would need another junction table
);

CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    doctor_id INT NOT NULL,
    facility_id INT NOT NULL,            -- Store facility for the specific appointment
    appointment_datetime DATETIME NOT NULL,
    reason TEXT,                         -- Optional reason for visit
    status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE, -- If user deleted, remove their appointments
    FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE CASCADE, -- If doctor deleted, remove appointments
    FOREIGN KEY (facility_id) REFERENCES facilities(facility_id) ON DELETE CASCADE -- If facility deleted, remove appointments
);

-- Example: Insert some basic accessibility features
INSERT INTO accessibility_features (name, description) VALUES
('Ramp Access', 'Facility entrance accessible via ramp.'),
('Elevator', 'Multi-floor facility accessible via elevator.'),
('Accessible Parking', 'Designated accessible parking spaces available.'),
('Accessible Restroom', 'Restroom designed for wheelchair accessibility.'),
('Step-Free Access', 'Main entrance and relevant areas have no steps.');
