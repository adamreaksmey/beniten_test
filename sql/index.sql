-- Question 1
Question 1:
CREATE TABLE staff (
    staff_id INT PRIMARY KEY AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL, 
    sex ENUM('Male', 'Female') NOT NULL, 
    date_of_birth DATE NOT NULL, 
    address TEXT, 
    phone VARCHAR(20) UNIQUE, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE positions ( -- Renamed based on Laravel conventions (plural form)
    position_id INT PRIMARY KEY AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL UNIQUE, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE staff_positions ( -- Renamed based on Laravel conventions (plural form)
    staff_position_id INT PRIMARY KEY AUTO_INCREMENT, 
    staff_id INT NOT NULL, 
    position_id INT NOT NULL, 
    start_date DATE NOT NULL, 
    end_date DATE DEFAULT NULL, -- NULL if currently in position
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id) ON DELETE CASCADE, 
    FOREIGN KEY (position_id) REFERENCES positions(position_id) ON DELETE CASCADE
);

-- Question 2
Following Laravel's conventions:

Table Names:

staff → ✅ (Fine, as it's uncountable)
position ❌ → Should be positions (plural form)
staff_position ❌ → Should be staff_positions (plural form)
Column Names:

staff_id → ✅ (Good convention)
position_id → ✅ (Good convention)
staff_position_id ❌ → Should just be id, as Laravel prefers id for primary keys.
sex ❌ → Should be gender for better clarity.
created_at & updated_at → ✅ (Good convention)

-- Question 3
SELECT 
    s.staff_id, 
    s.name, 
    s.sex, 
    s.date_of_birth, 
    s.address, 
    s.phone, 
    p.name AS current_position
FROM staff s
JOIN staff_positions sp ON s.staff_id = sp.staff_id
JOIN positions p ON sp.position_id = p.position_id
WHERE sp.end_date IS NULL;

-- Question 4
SELECT 
    s.staff_id, 
    s.name, 
    s.sex, 
    s.date_of_birth, 
    s.address, 
    s.phone, 
    p.name AS current_position
FROM staff s
JOIN staff_positions sp ON s.staff_id = sp.staff_id
JOIN positions p ON sp.position_id = p.position_id
WHERE DATEDIFF(NOW(), sp.start_date) > 730; -- 2 years = 730 days
