-- region Auvergne-Rhône-Alpes

UPDATE department SET reg_id = 1 WHERE id IN ('01', '03', '07', '15', '26', '38', '42', '43', '63', '69', '73', '74');

-- region Bourgogne-Franche-Comté

UPDATE department SET reg_id = 2 WHERE id IN ('21', '58', '71', '89', '25', '39', '70', '90');

-- region Bretagne

UPDATE department SET reg_id = 3 WHERE id IN ('29', '22', '56', '35');

-- region Centre-Val-de-Loire

UPDATE department SET reg_id = 4 WHERE id IN ('18', '28', '36', '37', '41', '45');

-- region Corse

UPDATE department SET reg_id = 5 WHERE id IN ('2A', '2B');

-- region Grand-Est

UPDATE department SET reg_id = 6 WHERE id IN ('08', '10', '51', '52', '54', '55', '57', '67', '68', '88');

-- region Guadeloupe

UPDATE department SET reg_id = 7 WHERE id IN ('971');

-- region Guyane

UPDATE department SET reg_id = 8 WHERE id IN ('973');

-- region Hauts-de-France

UPDATE department SET reg_id = 9 WHERE id IN ('02', '59', '60', '62', '80');

-- region Ile-de-France

UPDATE department SET reg_id = 10 WHERE id IN ('75', '77', '78', '91', '92', '93', '94', '95');

-- region La Reunion

UPDATE department SET reg_id = 11 WHERE id IN ('974');

-- region Martinique

UPDATE department SET reg_id = 12 WHERE id IN ('972');

-- region Mayote

UPDATE department SET reg_id = 13 WHERE id IN ('976');

-- region Normandie

UPDATE department SET reg_id = 14 WHERE id IN ('14', '27', '50', '61', '76');

-- region Nouvelle-Aquitaine

UPDATE department SET reg_id = 15 WHERE id IN ('16', '17', '19', '23', '24', '33', '40', '47', '64', '79', '86', '87');

-- region Occitanie

UPDATE department SET reg_id = 16 WHERE id IN ('09', '11', '12', '30', '31', '32', '34', '46', '48', '65', '66', '81', '82');

-- region Pays-de-la-Loire

UPDATE department SET reg_id = 17 WHERE id IN ('44', '49', '53', '72', '85');

-- region Provence-Alpes-Côte-d'azur

UPDATE department SET reg_id = 18 WHERE id IN ('04', '05', '06', '13', '83', '84');
