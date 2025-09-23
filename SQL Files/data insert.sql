
INSERT INTO status (
    status_type 
) VALUES ('Open'), ('On Progress'), ('Pending'), ('RMA to Vendor'), ('On-QC'), ('Completed'), ('Canceled'), ('Returned to Client'); 

-- INSERT INTO users (
--     username, email, password 
-- ) VALUES ('admin3', 'admin3@gmail.com', '$2y$10$12GSpJaGC.r5qE6iQcQYKuTSqU7AeH7Rs./L6JZvAx70FQgqkexrW'); 

INSERT INTO users (
    username, email, password, role
) VALUES ('superadmin', 'flyingfishsuperadmin@gmail.com', '$2y$10$ZsbXxrDqBUCc3s/1c8wqcej.x2aq2iVHu6ulIS3uAT1egly8SK7oi', 1); 

-- $2y$10$ZsbXxrDqBUCc3s/1c8wqcej.x2aq2iVHu6ulIS3uAT1egly8SK7oi
-- flyingfish321


INSERT INTO service_type (
    service_type_name 
) VALUES ('On-Site'), ('Carry-In');

-- 1 = onsite
-- 2 = carry in

INSERT INTO warranty (
    warranty_status 
) VALUES ('Active'), ('Expired'), ('Void');

INSERT INTO service_logs (
	date_in, received_from, alamat, mobile_number, email, contact_person, serial_number, part_number, SKU, brand_type,
    description_product, problem, pre_diagnostic, add_on, create_by, sales_order, invoice_date, warranty_status, service_type,
    part_ready, return_date, completed_date, created_at, updated_at
) VALUES
(now(), 'Customer A', '123 Main St', '081200011', 'customer11@example.com', 'John Doe11', 'SN1234567811', 'PN987654311', 
'SKU011', 'BrandX11', 'Product description A', 'Problem A', 'pre_diagnostic A',  'Add-on A', '1', 'SO12345', 
'2024-01-10', '2', '1', '2024-01-15', '2024-01-20', '2024-01-25', NOW(), NOW());

INSERT INTO notes (
    service_logs_id, teknisi_id, note_content 
) VALUES ('TL2507001154', '3', 'Void123456690876 54321');

-- update service_logs
-- SET status_id = 2
-- Where techlog_id = "TL250600101"