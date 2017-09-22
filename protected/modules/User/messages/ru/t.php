<?php
/**
 * Localization for UserModule
 * @version Russian
 */
return array(
    'USER' => 'Пользователь',
    'USERS' => 'Пользователи',
    'PROFILE' => 'Профиль',
    'PROFILES' => 'Профили',
    'PASSWORD_HASH' => 'Зашифрованный пароль',
    'REGISTER' => 'Зарегистрировать',
    'REGISTER_USER' => 'Зарегистрировать нового пользователя',
    'REMEMBER_ME' => 'Запомнить',
    'SIGN_IN' => 'Вход',
    'LOGIN_METHOD' => 'Выберите метод идентификации',
    'AUTHENTICATION' => 'Вход',
	'AUTHENTICATION_USER' => 'Вход пользователя Intranet',
    'AUTHENTICATION_CLIENT' => 'Вход клиента',
    'QUERY_NOT_USER' => 'Вы не пользователь?',
    'LOGIN_AS_CLIENT' => 'Войти как клиент',
    'MINE_PROFILE' => 'Мой профиль',
    'INFO_USER_WORKTIME' => 'Время работы пользователя',

    'CREATE_USER' => 'Создать пользователя',
    'VIEW_USERS' => 'Показать пользователей',
    'VIEW_USER' => 'Показать пользователя',
    'EDIT_USER' => 'Редактировать пользователя',
    'DELETE_USER' => 'Удалить пользователя',
    'UPDATE_USER' => 'Обновить пользователя',
    'MANAGE_USERS' => 'Управление Пользователями',
    'MANAGE_SQL_USERS' => 'Управление Sql Пользователями',
    'MANAGE_CLI_SQL_USERS' => 'Управление Клиентами Sql Пользователями',
	
	'ACTIVE_ALL_USERS' => 'Активировать всех пользователей',
	'BLOCK_ALL_USERS' => 'Блокировать всех пользователей',

    //User Model attributes Labels
    'USERNAME' => 'Имя пользователя',
    'USERNAMEMESSAGE' => 'Имя пользователя не соответстует общим правилам создания имени пользователя. Имя пользователя должно содержать только латинские буквы, цифры и должно содержать не менее 5 символов.',
    'PASSWORD' => 'Пароль',
    'REPEAT_PASSWORD' => 'Повторите пароль',
    'PASSPHRASEMESSAGE' => 'Пароль',
	
	'RESET_PASSWORD' => 'Сброс пароля',
	'RESET_SETTINGS' => 'Сброс настроек',
	
    //'AD_USERNAME'=>'Utilizator Active Directory',
    'AD_USERNAME' => 'LDAP пользователь',
	'ROLE' => 'Роль',
    'SQL_USER' => 'Sql пользователь',
	
	'confirmation'=>'Пользовательское соглашение',
    'regle'=>'Политика конфиденциальности',

    //Profile Model attributes labels
    'EMAIL' => 'Электронная почта',
    'IDNP' => 'Фискальный код',
    'IDNPMESSAGE' => 'Фискальный код не соответствует правилам созданья. Фискальный код должен содержать только цифры, иметь больше 7 символов и меньше 14.',
    'FIRSTNAME' => 'Имя',
    'FIRSTNAMEMESSAGE' => 'Имя не соответствует общим правилам создания. Оно должно содержать только латинские буквы.',
    'LASTNAME' => 'Фамилия',
    'LASTNAMEMESSAGE' => 'Фамилия не соответствует общим правилам создания. Она должно содержать только латинские буквы.',
    'PATRONYMIC' => 'Отчество',
    'GENDER' => 'Пол',
    'MALE' => 'Мужской',
    'FEMALE' => 'Женский',
    'BIRTHDAY' => 'День рожденья',
    'ABOUT' => 'Описание',
    'SUBSIDIARY' => 'Филиал',
    'DEPARTMENT' => 'Отдел',
    'LOCALITY' => 'Населенный пункт',
    'PHONE' => 'Номер домашнего телефона',
    'MOBILE' => 'Номер сотового телефона',
	'UNKNOWN' => 'Неизвестно',
	'AVATAR' => 'Аватар',

    //CertificateForm Model attributes labels
    'PRIVATE_KEY' => 'Частный ключ',
    'PASSPHRASE' => 'Пароль шифрования',
	'PASSPHRASEMESSAGE' => 'Your password does not meet our password complexity policy.
                The password can only contain letters, numbers, the underscore,the hyphen, and minimum length of password is 6 chars.',
    'REPEAT_PASSPHRASE' => 'Повторите пароль',
    'COUNTRY_NAME' => 'Название страны',
    'STATE_OR_PROVINCE_NAME' => 'Название провинции (области)',
    'LOCALITY_NAME' => 'Название города/села',
    'ORGANIZATION_NAME' => 'Название организации',
    'ORANIZATIONAL_UNIT_NAME' => 'Название отдела организации',
    'COMMON_NAME' => 'Привычное имя',


    // FieldForm Model attributes labels
    'FIELD_TYPE' => 'Тип поля',
    'LENGTH' => 'Длина',
    'DEFAULT_VALUE' => 'Значение по умолчанию',
    'REFERNCES_TABLE' => 'Отсылаемая таблица',
    'REFERENCES_COLUMN' => 'Отсылаемый столбец',
    'VALUES' => 'Значения',
    'NAME' => 'Имя',
    'TYPE' => 'Тип',
    'PLACE' => 'Место',
    'AFTER' => 'После:',
    'AT_END_OF_TABLE' => 'К концу таблицы',
    'AT_BEGINNING_OF_TABLE' => 'К началу таблицы',
    'FROM_ANOTHER_TABLE' => 'Из другой таблицы',


    // PasswordForm attributes labels
    'CURRENT_PASSWORD' => 'Текущий пароль',
    'NEW_PASSWORD' => 'Новый пароль',
    'CHANGE_PASSWORD' => 'Изменить свой пароль',
    '' => '',

    'FIELD' => 'Поле',
    'FIELDS' => 'Поля',

    'ADD_FIELD' => 'Добавить новое поле',
    'New Field' => 'Новое поле',
    'DELETE_FIELD' => 'Удалить поле',

    //'Create Profile' => 'Creează Profil',
    'VIEW_PROFILE' => 'Просмотр профиля',
    'EDIT_PROFILE' => 'Редактировать профиль',
    'DELETE_PROFILE' => 'Удалить профиль',
    'UPDATE_PROFILE' => 'Обновить профиль',
    'MANAGE_PROFILES' => 'Управление профилями',
    'Choose a field from the list.' => 'Выбери поле из списка.',

    'Are you sure you want to delete this item?' => 'Вы уверены, что хотите удалить этот элемент?',
    'Are you sure you want to delete this user?' => 'Вы уверены, что хотите удалить этого пользователя?',


    'CERTIFICATE_USER_HINT' => 'Selectează utilizatorul pentru care se creează certificatul',
    'CERTIFICATES' => 'Сертификаты',
    'CERTIFICATE_INFO' => 'Informații despre certificat.',
    'CERTFICATE_PASSPHRASE' => 'Parola necesară pentru protejarea cheii private.',

    'ADDITIONAL_FIELDS' => 'Дополнительные поля для профиля Пользователя',
    'ADD_INFO' => 'Дополнительная информация',
    'BASE_INFO' => 'Основная информация',

    //Add here the labels for all field added dinamicaly
    'USER_MODULE_INSTALL_MESSAGE' => 'Acest proces va crea toate tabelele necesare pentru Modulul User. Tabelele anterioare vor fi șterse; este posibil să pierdeți informații.',
    'INSTALLATION_AGREE' => 'Am citit și vreau să instalez',
    'Service Access' => 'Acces servicii',
    'Service' => 'Serviciu',
    'MANAGE_CLIENTS' => 'Управление Клиентами',

);