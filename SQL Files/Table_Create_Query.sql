CREATE TABLE status (
  `id` int NOT NULL AUTO_INCREMENT,
  `status_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
);

CREATE TABLE users (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 3,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  
  UNIQUE KEY `users_email_unique` (`email`),
  PRIMARY KEY (`id`)
);

CREATE TABLE service_type (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_type_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
);

CREATE TABLE warranty (
  `id` int NOT NULL AUTO_INCREMENT,
  `warranty_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
);


CREATE TABLE service_logs (
   `id` int NOT NULL AUTO_INCREMENT,

    `techlog_id` varchar(12) NOT NULL DEFAULT 'N/A',
    
	date_in date,
    
    received_from varchar(255),
    alamat varchar(255),
    mobile_number varchar(255),
    email varchar(255),
    contact_person varchar(255),
    
    serial_number varchar(255),
    part_number varchar(255),
    SKU varchar(255),
    brand_type varchar(255),
    
    description_product TEXT,
    problem TEXT,
	pre_diagnostic TEXT,
    add_on TEXT,
    
    sales_order varchar(255),
    invoice_date date,
   --  warranty_expired date,
   
	-- warranty status dibuat table sendiri
    `warranty_status` varchar(255),
	`create_by` int(11),
	`service_type` int(11) DEFAULT NULL,
	`status_id` int(11) DEFAULT 1,
	-- `teknisi_id` int(11) DEFAULT NULL,
    
	part_ready date,
    completed_date date,
	return_date date,
    
--     note_CSP TEXT,
--     note_RMA TEXT,
--     note_support TEXT,
--     note_cashier TEXT,
--     note_teknisi TEXT,
-- bikin table sendiri buat notes   
    
    created_at timestamp NOT NULL DEFAULT current_timestamp(),
	updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
    
    PRIMARY KEY (id),
    
    -- TECHLOG ID AKAN DI RESET PER TAHUN
    UNIQUE (techlog_id),
    
	KEY `fk_service_type` (`service_type`),
	CONSTRAINT `fk_service_type` FOREIGN KEY (`service_type`) REFERENCES `service_type` (`id`) ON DELETE CASCADE,

	KEY `fk_status` (`status_id`),
	CONSTRAINT `fk_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,

-- 	KEY `fk_teknisi` (`teknisi_id`),
-- 	CONSTRAINT `fk_teknisi` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    
	KEY `fk_create_by` (`create_by`),
	CONSTRAINT `fk_create_by` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
    
    -- Foreign key buat Warranty bakal diurus dari sisi laravel
	-- KEY `fk_warranty` (`warranty_status`),
-- 	CONSTRAINT `fk_warranty` FOREIGN KEY (`warranty_status`) REFERENCES `warranty` (`id`) ON DELETE CASCADE
);

CREATE TABLE status_updatelog (
    id int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id),
	
	`service_logs_id` varchar(255) NOT NULL,
	`status_id` int(11) DEFAULT NULL,
	`teknisi_id` int(11) DEFAULT NULL,
	 status_note text,
    
    created_at timestamp NOT NULL DEFAULT current_timestamp(),

	KEY `fk_techlog_forUpdatelog` (`service_logs_id`),
	CONSTRAINT `fk_techlog_forUpdatelog` FOREIGN KEY (`service_logs_id`) REFERENCES `service_logs` (`techlog_id`) ON DELETE CASCADE,

	KEY `fk_status_forUpdatelog` (`status_id`),
	CONSTRAINT `fk_status_forUpdatelog` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,
    
	KEY `fk_teknisi_forUpdatelog` (`teknisi_id`),
	CONSTRAINT `fk_teknisi_forUpdatelog` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

CREATE TABLE `notes` (
	id int NOT NULL AUTO_INCREMENT,
  
	`service_logs_id` varchar(255) NOT NULL,
	`teknisi_id` int(11) DEFAULT NULL,
    
	note_content varchar(255) NOT NULL,
	created_at timestamp NOT NULL DEFAULT current_timestamp(),

	PRIMARY KEY (`id`),
      
	KEY `fk_techlog_forNotes` (`service_logs_id`),
	CONSTRAINT `fk_techlog_forNotes` FOREIGN KEY (`service_logs_id`) REFERENCES `service_logs` (`techlog_id`) ON DELETE CASCADE,
    
	KEY `fk_teknisi_forNotes` (`teknisi_id`),
	CONSTRAINT `fk_teknisi_forNotes` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

DELIMITER $$

-- CREATE TRIGGER status_updatelog_insert
-- AFTER UPDATE ON service_logs
-- FOR EACH ROW
-- BEGIN
-- 	IF (OLD.status_id != NEW.status_id and OLD.techlog_id = NEW.techlog_id) THEN 
-- 		INSERT INTO status_updatelog(service_logs_id, status_id, teknisi_id)
-- 		VALUES (NEW.techlog_id, NEW.status_id, NEW.teknisi_id);
-- 	END IF;
-- END$$

DELIMITER ;;

-- CREATE TABLE RMA_logs (
-- 	RMAlog_id varchar(255) NOT NULL,
-- 	RMAlog_detail TEXT,
-- 	`service_logs_id` varchar(255) NOT NULL,

-- 	PRIMARY KEY (RMAlog_id),
-- 	KEY `fk_techlog` (`service_logs_id`),
-- 	CONSTRAINT `fk_techlog` FOREIGN KEY (`service_logs_id`) REFERENCES `service_logs` (`techlog_id`) ON DELETE CASCADE
-- );
