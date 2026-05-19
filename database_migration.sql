-- =====================================================
-- MIGRACION: Agregar rol y created_at a usuarios
-- Ejecuta esto en phpMyAdmin > sistema_login > SQL
-- =====================================================

ALTER TABLE usuarios ADD COLUMN rol VARCHAR(20) NOT NULL DEFAULT 'user';
ALTER TABLE usuarios ADD COLUMN created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

-- Cambia el email por el tuyo para hacerte admin
UPDATE usuarios SET rol = 'admin' WHERE email = 'TU_EMAIL_AQUI';

-- =====================================================
-- TABLA FAVORITOS
-- =====================================================
CREATE TABLE IF NOT EXISTS favoritos (
    usuario_id INT NOT NULL,
    liga       VARCHAR(10) NOT NULL,
    equipo_id  INT NOT NULL,
    PRIMARY KEY (usuario_id, liga, equipo_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
