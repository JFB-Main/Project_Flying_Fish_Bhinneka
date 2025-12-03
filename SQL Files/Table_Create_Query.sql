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
  `module_role` int(11) NULL, -- The new column for module access (1 ff, 2 dps)
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
    
	note_content TEXT NOT NULL,
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


-- Table pelanggan_dps
CREATE TABLE pelanggan_dps (
    id INT AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    nomor_telepon VARCHAR(255),
    alamat VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
);

---

-- Table alamat_servis_dps
CREATE TABLE alamat_servis_dps (
    id INT AUTO_INCREMENT,
    nama_alamat VARCHAR(255) NOT NULL,
    id_pelanggan INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`),
    KEY `fk_pelanggan_alamat_idx` (`id_pelanggan`),
    CONSTRAINT `fk_pelanggan_alamat` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan_dps` (`id`) ON DELETE CASCADE
);

-- Table produk_dps (Verified reference to `warranty` table)
CREATE TABLE produk_dps (
    id INT AUTO_INCREMENT,
    sku_produk VARCHAR(255),
    nama_produk VARCHAR(255) NOT NULL,
    serial_number VARCHAR(255) UNIQUE,
    nomor_invoice VARCHAR(255),
    sales_order VARCHAR(255),
    id_warranty INT,
    id_alamat_servis INT,
    id_pelanggan_dps INT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`),
    
    KEY `fk_alamat_produk_idx` (`id_alamat_servis`),
    CONSTRAINT `fk_alamat_produk` FOREIGN KEY (`id_alamat_servis`) REFERENCES `alamat_servis_dps` (`id`) ON DELETE SET NULL,
    
    KEY `fk_pelanggan_produk_idx` (`id_pelanggan_dps`),
    CONSTRAINT `fk_pelanggan_produk` FOREIGN KEY (`id_pelanggan_dps`) REFERENCES `pelanggan_dps` (`id`) ON DELETE CASCADE
);

-- Table tipe_service_dps
CREATE TABLE tipe_service_dps (
    id INT AUTO_INCREMENT,
    nama_tipe_service VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
);

-- Insert data into tipe_service_dps
INSERT INTO tipe_service_dps (nama_tipe_service) VALUES
('Instalasi'),
('Presite Remote'),
('Presite Onsite'),
('Servis Remote'),
('Servis Onsite'),
('Servis Call');

---

-- Table status_dps
CREATE TABLE status_dps (
    id INT AUTO_INCREMENT,
    status_type VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`)
);

-- Insert data into status_dps
INSERT INTO status_dps (status_type) VALUES
('Open'),
('Menunggu Servis'),
('Dalam Pengerjaan'),
('Selesai');


CREATE TABLE service_logs_dps (
    id INT AUTO_INCREMENT,
    nomor_service VARCHAR(255) UNIQUE NOT NULL DEFAULT 'N/A',
    id_tipe_service INT DEFAULT NULL,
    status INT DEFAULT 1,
    
    jadwal_kunjungan DATE,
    waktu_mulai DATETIME,
    waktu_selesai DATETIME,
    
    id_produk INT,
    id_pelanggan INT,
    id_alamat_servis INT,
    
    id_teknisi INT UNSIGNED, -- Foreign key for the assigned technician
    created_by INT UNSIGNED, -- Foreign key for the user who created the log
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    
    permasalahan TEXT,
    
    PRIMARY KEY (`id`),
    
    KEY `fk_tipe_service_log_idx` (`id_tipe_service`),
    CONSTRAINT `fk_tipe_service_log` FOREIGN KEY (`id_tipe_service`) REFERENCES `tipe_service_dps` (`id`),
    
    KEY `fk_status_log_idx` (`status`),
    CONSTRAINT `fk_status_log` FOREIGN KEY (`status`) REFERENCES `status_dps` (`id`),
    
    KEY `fk_produk_log_idx` (`id_produk`),
    CONSTRAINT `fk_produk_log` FOREIGN KEY (`id_produk`) REFERENCES `produk_dps` (`id`) ON DELETE CASCADE,
    
    KEY `fk_pelanggan_log_idx` (`id_pelanggan`),
    CONSTRAINT `fk_pelanggan_log` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan_dps` (`id`) ON DELETE CASCADE,
    
    KEY `fk_alamat_log_idx` (`id_alamat_servis`),
    CONSTRAINT `fk_alamat_log` FOREIGN KEY (`id_alamat_servis`) REFERENCES `alamat_servis_dps` (`id`) ON DELETE SET NULL,
    
    KEY `fk_teknisi_log_idx` (`id_teknisi`),
    CONSTRAINT `fk_teknisi_log` FOREIGN KEY (`id_teknisi`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    
    KEY `fk_creator_log_idx` (`created_by`),
    CONSTRAINT `fk_creator_log` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
    
        -- fk binding ke table warranty diurus via laravel: Service_logs_dpsModel "model table ini" belongs to warrantymodel 
    -- & warrantymodel has many model tabel ini.
    --
    -- di bind display di blade.php via something like this: {{$sl->warranty_bind ? $sl->warranty_bind->warranty_status: 'N/A'}}
    -- via:
    -- #[Computed]
    -- public function sl()
    -- {
    --    return Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->find($this->id);
    -- }

) ENGINE=InnoDB;

-- Table notes_dps (Revised with id_teknisi FK)
CREATE TABLE notes_dps (
    id INT AUTO_INCREMENT,
    id_service_logs_dps INT DEFAULT NULL,
    id_teknisi INT UNSIGNED, -- Now linked to the users table
    note_content TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`),
    
    KEY `fk_service_logs_notes_idx` (`id_service_logs_dps`),
    CONSTRAINT `fk_service_logs_notes` FOREIGN KEY (`id_service_logs_dps`) REFERENCES `service_logs_dps` (`id`) ON DELETE CASCADE,
    
    KEY `fk_teknisi_notes_idx` (`id_teknisi`),
    CONSTRAINT `fk_teknisi_notes` FOREIGN KEY (`id_teknisi`) REFERENCES `users` (`id`) ON DELETE SET NULL
);

CREATE TABLE status_updatelog_dps (
    id int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id),
	
	`service_logs_id_dps` int(11) DEFAULT NULL,
	`status_id` int(11) DEFAULT NULL,
	 status_note text,
    
    created_at timestamp NOT NULL DEFAULT current_timestamp(),

	KEY `fk_service_logs_status_updatelog_dps_idx` (`service_logs_id_dps`),
	CONSTRAINT `fk_service_logs_status_updatelog_dps_idx` FOREIGN KEY (`service_logs_id_dps`) REFERENCES `service_logs_dps` (`id`) ON DELETE CASCADE,

	KEY `fk_status_forUpdatelogdps_idx` (`status_id`),
	CONSTRAINT `fk_status_forUpdatelogdps_idx` FOREIGN KEY (`status_id`) REFERENCES `status_dps` (`id`) ON DELETE CASCADE
);


-- ALTER TABLE users
-- ADD COLUMN module_role VARCHAR(255) NULL;

-- ALTER TABLE warranty ENGINE=InnoDB;