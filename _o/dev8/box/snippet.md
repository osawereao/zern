			/* 1st Query
			$query = "SELECT `PUID`, `type`, `password` FROM `{$table}`";
			$query .= " WHERE '" . $userid . "' IN (`email`,`phone`, `username`)";
			$query .= " OR `username` = '" . self::ocrypt($userid, 'oEN64') . "'";
			$query .= ' LIMIT 1';
			*/