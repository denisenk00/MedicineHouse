SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE DOCTORS
(
  doctor_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  specialization VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  human_id INT(11) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PATIENTS
(
  patient_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  birth_date Date NOT NULL,
  sex VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci CHECK (sex IN ('MAN', 'WOMAN')),
  human_id INT(11) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CONCLUSIONS
(
  conclusion_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  patient_id INT(11) NOT NULL,
  doctor_id INT(11) NOT NULL,
  conclusion_date Date NOT NULL,
  symptoms text COLLATE utf8mb4_unicode_ci NOT NULL,
  recommendations text COLLATE utf8mb4_unicode_ci NOT NULL,
  name VARCHAR(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE CONCLUSIONS ADD KEY (patient_id), ADD KEY (doctor_id);

CREATE TABLE HUMANS
(
  human_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  last_name VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  email VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  phone VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  password text NOT NULL COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE CONCLUSIONS
  ADD CONSTRAINT gets
    FOREIGN KEY (patient_id)
    REFERENCES PATIENTS (patient_id)
;

ALTER TABLE CONCLUSIONS
  ADD CONSTRAINT gives
    FOREIGN KEY (doctor_id)
    REFERENCES DOCTORS (doctor_id)
;

ALTER TABLE DOCTORS
  ADD CONSTRAINT can_be_a_doctor
    FOREIGN KEY (human_id)
    REFERENCES HUMANS (human_id)
;

ALTER TABLE PATIENTS
  ADD CONSTRAINT can_be_a_patient
    FOREIGN KEY (human_id)
    REFERENCES HUMANS (human_id)
;

INSERT INTO humans (first_name, last_name, email, phone, password) VALUES('Sys', 'Adm', 'SYSADM', '+380 (00) 000-0000', '$2a$12$z4vBUb62poadmn9Fx2.lYO5lWDGPKMvQvVCDUZLebHqNR.RHCmQcy' /*medhouse*/);

COMMIT;
