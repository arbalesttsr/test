<?php
/**
 * Description of module RO
 *
 * @author birca vitalii
 */

return array(
    "id" => "Identificator",
    "title" => "Titlu",
    "name" => "Nume",
    "code" => "Cod",
    "storage" => "Stocare",
    "path" => "Adresa URL",
    "extension" => "Extensie",
    "extensions" => "Extensii Permise",
    "file_size" => "Dimensiune Fisier (Mb)",
    "content_type" => "Tip de Continut",
    "icon" => "Imagine",
    "create_user_id" => "Creat de",
    "create_datetime" => "Creat la",
    "update_user_id" => "Actualizat de",
    "update_datetime" => "Actualizat la",
    "error_404" => "Pagina ceruta nu exista.",
    "error_500_open" => "Failed to open stream: No such file or directory ",
    "error_must_be_dir" => "must be a directory",
    "error_format" => "Format inadmisibil",
    "error_500_delete" => "Failed to delete file: No such file or directory ",
    "fields_required" => "Cimpurile cu <span class='required'>*</span> sunt obligatorii.",
    "could_not_make" => "Could not make ",
    "failed_to_copy" => "Failed to copy ",
    "empty_format_list" => "-- Selectati formatele --",
    "add_format" => "AdaugĂ Format",
    "remove_format" => "Șterge Format",
    "create" => "Crează",
    "update" => "Actualizează",
	'edit' => 'Editează',
    "delete" => "Șterge",
    "save" => "Salvează",
    "list" => "Listează",
    "view" => "Vezi",
	'reset' => 'Resetează',
    "manage" => "Administrează",
    "documentscategories" => " Categorii de Documente",
    "filesformats" => " Formate de Fisiere",
    "storages" => " Directorii de Stocare",
    "AdvancedSearch" => "Căutare Avansată",
    "search" => "Căutare",
    "textFromAdminManagePage" => "You may optionally <b>enter</b> a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.",
	//from login and recovery pages
	'pass'=>'Parola gresita de 5 ori, asteptati ',
	'minute'=>' minute',
	'LOGIN'=>'LOGARE',
	'RESET'=>'RESETARE',
	'Forgot your password?'=>'Ați uitat parola?',
	'Aveti deja un cont in sistem?'=>'Aveți deja un cont în sistem?',
	'Completati IDNP-ul si email-ul pentru a primi parola noua'=>'Completați IDNP-ul și email-ul pentru a primi parola nouă',
	'Recuperati Parola'=>'Recuperați parola',
	'Actualizati Parola'=>'Actualizați parola',
	'Logare'=>'Logare',
	'Va rugam sa completati datele dvs. personale'=>'Vă rugam să completați datele dvs. personale',
	'REGISTRATION'=>'Înregistrare',
	//from login->certificate login
	'Select file'=>'Alege fișier',
	'Change'=>'Modifică',
	//from mpass login
	'AUTHENTICATE'=>'AUTENTIFICARE',
	//user->models->chatmessage
	'msg'=>'Mesaj',
	'date'=>'Data',
	'from' =>'De la',
	'type' =>'Tipul',
	'to' =>'Pentru',
	'readed' => 'Citit',
	'create_user_id' =>'Creat de',
	'create_datetime' =>'Creat la',
	'update_user_id' =>'Actualizare de',
	'update_datetime' => 'Actualizare la',
	
	'STATUS' => 'Status',
	//modules-dynamicmenu-models-config
	'name_module' => 'Nume Modul',
	'name_controller' => 'Nume Controller',
	'name_action' => 'Nume Acţiune',
	'url' => 'Url',
	'icon' => 'Iconiţă',
	'is_enable' => 'Activ',
	//./protected/modules/DynamicMenu/models/DynamicMenu.php attribute labels
	'role_id' => 'Rolul',
	'actions_id' => 'Acțiunile',
	//
	'type_icon_id'=>'Tipul iconiței',
	//icon type attr labels
	'file'=>'Fișier',
	'number_icons' => 'Numărul de iconițe',
	'create_config' => 'Creare Configurație',
	'update_conf' => 'Actualizare Configurație ',
	'manage_conf' => 'Administrarea configurațiilor',
	'view_conf' => 'Deschide Configurația ',
	'delete_conf' => 'Șterge configurația',
	'The fields with' => 'Cîmpurile cu ',
	'are required' => ' sunt obligatorii.',
	'adv_search' => 'Căutare avansată',
	'adm_actions_by_roles' => 'Administrează acţiuni după roluri',
	'choose_role' => 'Alegeți rolul',
	'Noiembrie' => 'Noiembrie',
	'Octombrie' => 'Octombrie',
	'Miercuri' => 'Miercuri',
	'dateDB' => 'Marți, 28 Octombrie, 2014',
	'dateUser' => 'Vineri, 24 Octombrie, 2014',
	'Creare modul Dynamic Menu' => 'Creare modul Dynamic Menu',
	'Actiunile principale ale Modulului Dynamic Menu' => 'Acțiunile principale ale modulului Dynamic Menu',
	'mainDMmessage' => 'A fost creat modulul pentru gestionarea si administrarea dupa roluri a meniului lateral din
                        sistem.',
	'Configuraţii' => 'Configurații',
	'manage_actions' => 'Administrează acțiuni',
	'Generare Acţiuni Diferenţial' => 'Generare Acţiuni Diferenţial',
	'Regenerare Acţiuni' => 'Regenerare Acţiuni',
	'Administrare modul' => 'Administrare modul',
	'List of actions from system' => 'Lista acțiunilor din sistem',
	'Inregistrari pe o pagina:' => 'Înregistrări pe o pagină:',
	'search' => 'Căutare',
	
	//modul User
	//labels from clientSettings
	'time_limit' => 'Limita de timp',
	'restricted_id' => 'Limitat',
	'restricted_days' => 'Zilele limitate',
	'restricted_date' => 'Data limitată',
	'restricted_interval' => 'Intervalul limitat',
	'date_start' => 'Data de început',
	'start_time' => 'Timpul de început',
	'end_time' => 'Timpul de sfîrșit',
	'holiday_enable' => 'Activează Sărbători',
	//labels from holiday
	'holiday_date' => 'Data de sărbători',
	'description' => 'Descriere',
	//chat room view
	'Chat Room' => 'Cameră de chat',
	'allert no msg' => 'Nu există nici un mesaj în chat.',
	'put msg' => 'Introduceți textul mesajului aici',
	'priv msg' => 'Mesaj privat',
	'choose user' => 'Alegeți un utilizator',
	//sa access _form
	'FIELDS_ARE_REQUIRED' => 'Cîmpurile sunt obligatorii',
	'Sa Accesses' => 'Accesuri Sa',
	'add' => 'Adaugă',
	'cancel' => 'Anulează',
	'You may write "CURRENT_TIMESTAMP" or your own "value", without any quotes.' => 'Puteți scrie "CURRENT_TIMESTAMP" sau "value" proprie, fără ghilimele.',
	'Write values as: value1,value2,value3...valueN' => 'Scrieți valori ca: value1, value2, value3... valueN',
	'select' => 'Alege',
	//user
	'ACTIVATE' => 'Activează',
	'BLOCK' => 'Blochează',
	'DISABLE' => 'Dezactivează',
	
	'User Account' => 'Contul utilizatorului',
	'User Profile' => 'Profilul utilizatorului',
	'User Settings' => 'Setările utilizatorului',
	//usersettings
	'Restricted By Time' =>	'Limitat de timp',
	'Restricted By Date' =>	'Limitat de dată',
	'Restricted By Interval' => 'Limitat pe interval',
	'Restricted Dates Holidays' => 'Limitat zile de Sărbătoare',
	
	'Restrictionati utilizatorul dupa timp' => 'Restricționați utilizatorul după timp!',
	'timeAllert' => 'Setați mai întîi data de început și timpul în minute în care utilizatorul va avea acces la sistem.',
	
	'Restrictionati utilizatorul dupa data' => 'Restricționați utilizatorul după dată!',
	'dataAllert' => 'Setați o dată calendaristică pentru a restricționa utilizatorului accesul la sistem.',
	
	'Restrictionati utilizatorul dupa interval' => 'Restricționați utilizatorul pe un interval de timp!',
	'intervalAllert' => 'Setați intervalul, apoi setați programul de lucru în care utilizatorul va avea acces la sistem.',
	
	'Holidays Restriction' => 'Restricție Sărbători!',
	'holidayAllert' => 'Bifați ”Activează Sărbători” dacă doriți ca utilizatorul în zile de sărbători să nu aibă acces la sistem.',
	'Holidays Manage' => 'Administrează Sărbători',
	'Holidays' => 'Sărbători',
	'Create Holidays' => 'Crează Sărbătoare',
	'Manage User Holidays' => 'Administrează zilele de Sărbătoare a Utilizatorului',
	
	//view_user
	'penalization' => 'Penalizare',
	'Additional Information' => 'Informație suplimentară',
	
	//admin_cli_sql_users.php
	'atentie' => 'Atenție!',
	'Utilizatorul Db Sql pentru Clienti nu este creat, accesati butonul Create pentru a-l crea!' => 'Utilizatorul Db Sql pentru Clienți nu este creat, accesați butonul Creare pentru a-l crea!',
	'Create Db Sql User' => 'Creare Utilizator Db Sql',
	'Db Sql Username' => 'Nume Utilizator Db Sql',
	'Utilizatorul Db Sql pentru Clienti Exista' => 'Utilizatorul Db Sql pentru Clienți există!',
	'Delete Client Sql User' => 'Șterge Client Db Sql',
	'ADD_SQL_USER' => 'Adaugă Utilizator Sql',
	'not set' => 'Nu este setat',
	'Yes' => 'Da',
	'No' => 'Nu',
	'Not Active' => 'Nu este activ',
	
	//./protected/modules/User/views/userSettings/view.php
	'List UserSettings' => 'Listă Setări Utilizator',
	'Create UserSettings' => 'Crează Setări Utilizator',
	'Update UserSettings' => 'Actualizează Setări Utilizator',
	'Delete UserSettings' => 'Șterge Setări Utilizator',
	'Manage UserSettings' => 'Administrează Setări Utilizator',
	'View UserSettings' => 'Vizualizează Setări Utilizator',
	
	//LoginDB
	'Creare modul LoginDB' => 'Creare modul LoginDB',
	'A fost creat modulul de logare prin Baza de date' => 'A fost creat modulul de logare prin Baza de date',
	//user mainpage
	'Creare modul User' => 'Creare modul User',
	'userMsg' => 'A fost creată o nouă versiune a modulului User, odată cu noua temă Synapsis.',
	'Actiunile principale ale Modulului User' => 'Acțiunile principale ale modulului User',
	'Componente modul User' => 'Componente modul User',
	'compMsg' => 'Componentele de bază ale modulului au fost plasate în submodule.',
	'Monitorizare modul' => 'Monitorizare modul',
	'monitoringMsg' => 'Au fost adăugate 2 ferestre de monitorizare a utilizatorilor înregistrati și blocați',
	'Utilizatori Inregistrati' => 'Utilizatori înregistrați',
	'Utilizatori Blocati' => 'Utilizatori blocați',
	'Service Access' => 'Acces Servicii',
	'Role Based Access Manager' => 'Gestiunea Accesului pe baza rolurilor',
	'Logare prin Centrul de Telecomunicații Speciale' => 'Logare prin Centrul de Telecomunicații Speciale',
	'Logare din Baza de Date' => 'Logare din Baza de Date',
	'Logare Active Directory' => 'Logare Active Directory',
	'Logare prin Certificate' => 'Logare prin Certificate',
	
	//loginCertificates
	'Manage CertificateInfo' => 'Administrare Certificare',
	'Create CertificateInfo' => 'Creare Certificat',
	//create
	'Cert Crt' => 'Certificat',
	'Cert Key' => 'Cheie Certificat',
	'Select user' => 'Alege utilizator',
	//logincertificates mainpage
	'Februarie' => 'Februarie',
	'date1LoginCert' => 'Joi, 12 Februarie, 2015',
	'Modulul LoginCertificates' => 'Modulul LoginCertificates',
	'Actiunile principale ale Modulului LoginCertificates' => 'Acțiunile principale ale Modulului LoginCertificates',
	'Monitorizarea numarului de configurari certificate in Synapsis' => 'Monitorizarea numărului de configurări certificate în Synapsis',
	'date2LoginCert' => 'Joi, 12 Ianuarie, 2015',
	'Users with Certificates' => 'Utilizatori cu certificate',
	'Number of Certificate Settings' => 'Numărul de setări certificate',
	'message1' => 'Acest modul este destinat pentru configurarea logării utilizatorului prin certificate, în sistemul Synapsis.',
	'message2' => 'Urmează pașii de configurare și utilizare corectă a modulului.',
	
	'CREATE_CERTIFICATE_SETTINGS' => 'Crează Setări de Certificate',
	'MANAGE_CERTIFICATE_SETTINGS' => 'Administrează Setări de Certificate',
	'List CertSettings' => 'Listă Setări de Certificate',
	'Cert Settings' => 'Setări de Certificate',
	
	//attr labels certsettings
	'certificates_path' => 'Calea către Certificate',
	'key_path' => 'Calea către Chei',
	'openssl_config_path' => 'Calea către fișierul de configurare Openssl',
	'digest_alg' => 'Algoritmul Digest',
	'private_key_bits' => 'Biții Cheii Private',
	'private_key_type' => 'Tipul Cheii Private',
	'default_id' => 'Setările Active în mod Implicit',
	
	//logincertificates mainpage instructions
	'Pasul 1' => 'Pasul 1',
	'Crearea unei configurari Certificat Setting pentru a genera corect certificatul' => 'Crearea unei configurări Certificat Setting pentru a genera corect certificatul',
	'Pentru a crea o configurare pentru Certificat este necesar sa cunoastem urmatoarele date:' => 'Pentru a crea o configurare pentru Certificat este necesar să cunoaștem următoarele date:',
	'calea unde se va salva certificatul : "/data/certificates/"' => 'calea unde se va salva certificatul : "/data/certificates/"',
	'calea unde se va salva key : "/data/keys/"' => 'calea unde se va salva cheia : "/data/keys/"',
	'calea unde se afla fisier de config openssl : "/data/sslconfig/" (*)' => 'calea unde se află fișierul de configurare openssl : "/data/sslconfig/" (*)',
	'setarea digest algorithm : "SHA512" (recommended)' => 'setarea algoritmului de tip Digest : "SHA512" (recomandat)',
	'setarea Private Key Bits : 2048 (recommended)' => 'setarea Biților Cheii Private : 2048 (recomandat)',
	'setarea Private Key Type : OPENSSL_KEYTYPE_RSA (recommended)' => 'setarea Tipului Cheii Private : OPENSSL_KEYTYPE_RSA (recomandat)',
	
	'Pasul 2'=> 'Pasul 2',
	'Creare Certificate' => 'Creare Certificate',
	'Dupa ce am creat o configurare pentru certificat, cream o creeam insasi certificatul care utilizatorul o sa l foloseasca.' => 'După ce am creat o configurare pentru certificat, creăm însăși certificatul pe care utilizatorul îl va folosi.',
	
	'Pasul 3' => 'Pasul 3',
	'Dupa ce s-a creat certificatul , il vizualizam si accesam butonul Download Key, pentru a descarca certificatul' => 'După ce s-a creat certificatul , îl vizualizăm și accesăm butonul Download Key, pentru a descărca certificatul',
	'Descrierea va fi in curind ...' => 'Descrierea va fi în curînd...',
	
	//submodulul user->loginDB
	'Modulul LoginAD' => 'Modulul LoginAD',
	'Actiunile principale ale Modulului LoginAD' => 'Acțiunile principale ale Modulului LoginAD',
	'ADmess1' => 'Monitorizarea numărului de configurări LDAP și UserLdapRelation înregistrate în Synapsis',
	'Numarul LDAP Settings' => 'Numărul Setărilor LDAP',
	'Numarul UserLdapRelation' => 'Numărul UserLdapRelation',
	'MANAGE_LDAP_SETTINGS' => 'Administrează Setări LDAP',
	'MANAGE_USER_LDAP_RELATION'=> 'Administrează Legături Utilizator LDAP',
	'IMPORT_LDAP_USERS' => 'Importă utilizatori LDAP',
	'CREATE_LDAP_SETTINGS' => 'Crează Setări LDAP',
	'CREATE_USER_LDAP_RELATION' => 'Crează Legături Utilizator LDAP',
	
	//attr labels loginAD
	'ldap_host' => 'Hostul Ldap',
	'ldap_port' => 'Portul Ldap',
	'ldap_dc' => 'Controlerul de domeniu Ldap(DC)',
	'ldap_ou' => 'Unitate Organizațională Ldap(OU)',
	'ldap_username' => 'Nume Utilizator Ldap',
	'synapsis_user' => 'Utilizator Synapsis',
	'Ldap Setting' => 'Setare LDAP',
	'USER_AD' => 'Nume Utilizator AD',
	'PASSWORD_AD' => 'Parola AD',
	
	//loginAD
	'Update LdapSettings' => 'Actualizează Setări Ldap',
	'VIEW_LDAP_SETTINGS' => 'Vizualizează Setări Ldap',
	'LdapSettings' => 'Setări Ldap',
	'UPDATE_USER_LDAP_RELATION' => 'Actualizează Legături Utilizator LDAP',
	'View UserLdapRelation' => 'Vizualizează Legături Utilizator LDAP',
	'User Ldap Relations' => 'Legături Utilizator LDAP',
	'SELECT_LDAP_SETTING' => 'Selectați setare Ldap',
	'IMPORT_USERS_AD' => 'Importă utilizatori AD',
	'import message 1' => 'Pentru a importa utilizatorii din Active Directory este necesar un utilizator AD cu drepturi pentru căutare în AD și parola acestui utilizator.',
	'import message 2' => 'Conectează-te la LDAP cu numele și parola', 
	'GET LDAP USERS' => 'Obține Utilizator LDAP',
	
	//loginAD mainpage instructions
	'instr mess1' => 'Acest modul este destinat pentru configurarea LDAP, în sistemul Synapsis.',
	'instr mess2' => 'Pentru utilizarea LDAP e necesar ca el să fie instalat pe serverul php5-ldap , pentru a-l instala se execută urmatoarea comandă "apt-get install php5-ldap"',
	'instr mess3' => 'Urmează pașii de configurare și utilizare corectă a modulului.',
	
	'Crearea unei configurari LDAP prin intermediu modulului LoginAD' => 'Crearea unei configurări LDAP prin intermediul modulului LoginAD',
	'Pentru a crea o configurare LDAP este necesar sa cunoastem urmatoarele date:' => 'Pentru a crea o configurare LDAP este necesar să cunoaștem urmatoarele date:',
	'Numele Utilizatorului din Active Direcory' => 'Numele Utilizatorului din Active Directory',
	'*Parola Utilizatorului din Active Direcory (in cazul nostru nu o pastram in sistem , ea se va introduce de utilizator la etapa de logare)' =>
			'*Parola Utilizatorului din Active Directory (în cazul nostru nu o pastrăm în sistem , ea se va introduce de utilizator la etapa de logare)',
	'Host-ul unde se afla Active Directory' => 'Host-ul unde se află Active Directory',
	'Portul pentru Active Directory (la majoritatea portul este : 389)' => 'Portul pentru Active Directory (la majoritatea portul este: 389)',
	'Domain Controler' => 'Controlerul de domen(DC)',
	'Organisational-Unit' => 'Unitatea Organizațională (OU)',
	'Creare configurare LDAP' => 'Creare configurare LDAP',

	'Creare UserLdapRelation configurare' => 'Creare configurare Legături Utilizator LDAP',
	'instr mess4' => 'După ce am creat o Ldap configurare, creăm o configurare în care se indică utilizatorul și ce Ldap configurare să folosească.',
	
	'instr mess5' => 'Importarea Utilizatorilor din Active Directory în Synapsis',
	
	//login CTS mainpage
	'Creare modul LoginCTS' => 'Creare Modul LoginCTS',
	'A fost creat modulul de logare prin Centrul de Telecomunicații Speciale.' => 'A fost creat modulul de logare prin Centrul de Telecomunicații Speciale.',
	'Componente modul LoginCTS' => 'Componente modul LoginCTS',
	'Actiunile principale ale modulului LoginCTS.' => 'Acțiunile principale ale modulului LoginCTS.',
	'CREATE_SETTING' => 'Creare Setare',
	'SETTINGS' => 'Setări',
	
	//CTS attr labels
	'key' => 'Cheie',
	'certificate' => 'Certificat',
	'validate_response_key' => 'Validarea Cheii de Răspuns',
	'callback _url' => 'Url de Chemare Inversă',
	'login_url' => 'Logare Url',
	'logout_url' => 'Ieșire Url',
	'asserationNs' => 'Aserțiune Ns',
	'prefix' => 'Prefix',
	'issuer' => 'Emitent',
	'is_default' => 'Implicit',
	
	//cts pages
	'Manage Cts Settings' => 'Administrare Setări CTS',
	'Create Cts Settings' => 'Creare Setări CTS',
	'Url site emitent ex' => 'Url site emitent; ex: ',
	'Update CtsSettings' => 'Actualizează Setări CTS',
	'View Certificates' => 'Vizualizează Certificate',
	'View CtsSettings' => 'Vizualizează Setări CTS',
	'View Certificates Contents' => 'Vizualizează Conținutul Certificatelor',
	'file content' => 'Conținutul fișierului',
	'Cts Settings' => 'Setări CTS',
	
	//CLASSIFIER MODULE
	//mainpage
	'clas data1' => 'Marți, 28 Octombrie, 2014',
	'clas data2' => 'Luni, 17 Noiembrie, 2014',
	'Creare modul Clasificatoare' => 'Creare Modul Classifier',
	'A fost creat modulul pentru gestionarea Clasificatoarelor din sistem.' => 'A fost creat modulul pentru gestionarea Clasificatoarelor din Sistem.',
	'Actiunile principale ale Modulului Clasificatoare' => 'Acțiunile principale ale Modulului Classifier',
	'Adaugare clasificatoare de sistem' => 'Adăugare Clasificatoare de Sistem',
	'A fost separate clasificatoarele de baza de clasificatoarele generate in sistem, si se vor pastra in mapa' =>
			'Au fost separate clasificatoarele de bază de cele generate în sistem, și se vor păstra în mapa',
	'Acces spre clasificatoarele de sistem' => 'Acces spre Clasificatoarele de Sistem',
	
	'Listă Clasificatoare' => 'Listă Clasificatoare',
	'Crează clasificator' => 'Crează Clasificator',
	'RBAC clasificator' => 'RBAC Clasificator',
	'Listă Clasificatoare de Sistem' => 'Listă Clasificatoare de Sistem',
	
	//limit Access
	'manage_RBAC_clasificator' => 'Administrare Clasificatoare RBAC',
	'create_RBAC_clasificator' => 'Crează Clasificatoare RBAC',
	
	//system models attr labels
	//adress
	'Country' => 'Țara',
	'Region' => 'Regiunea',
	'Street' => 'Strada',
	'Postal Code' => 'Codul poștal',
	'Organisation' => 'Organizația',
	'Contact' => 'Contacte',
	//bank settings
	'state_tax' => 'Taxa de Stat',
	'service_tax' => 'Taxă de serviciu',
	'configuration_code_state' => 'Codul de Configurație a Statului',
	'bank_fiscal_code_state' => 'Codul Bancar Fiscal al Statului',
	'bank_account_state' => 'Contul Bancar al Statului',
	'treasury_account_name_state' => 'Numele Contului Trezorial al Statului',
	'beneficiary_name_state' => 'Numele Beneficiarului de Stat',
	'treasury_account_state' => 'Contul Trezorial al Statului',
	'line_id_state' => 'Id-ul Liniei de Stat',
	'reason_state' => 'Motivul transferului din partea Statului',
	'configuration_code_service' => 'Codul de Configurație a Beneficiarului',
	'bank_fiscal_code_service' => 'Codul Bancar Fiscal al Beneficiarului',
	'bank_account_service' => 'Contul Bancar al Beneficiarului',
	'beneficiary_name_servie' => 'Numele Beneficiarului de Serviciu',
	'treasury_account_name_servie' => 'Numele Contului Trezorial al Beneficiarului',
	'treasury_account_service' => 'Contul Trezorial al Beneficiarului',
	'line_id_service' => 'Id-ul Liniei de Serviciu',
	'reason_service' => 'Motivul transferului din partea Beneficiarului',
	//CONTACTS book
	'Name Surname' => 'Nume, Prenume',
	'Series' => 'Seria',
	'Address' => 'Adresa',
	'Address Identity' => 'Identitate Adresă',
	//department
	'Bank Setings' => 'Setările Băncii',
	//locality
	'Locality Type' => 'Tipul Localității',
	//nationality
	'Full Name' => 'Numele Complet',
	//owncloud conf
	'Admin User' => 'Utilizatorul Administrator',
	'Default Folder' => 'Mapă Implicită',
	//region
	'Region Type' => 'Tipul Regiunii',
	//end system model
	//create table, sidebar
	'Lista Atribute' => 'Listă Atribute',
	'Adauga cimpuri pentru clasificator' => 'Adaugă cîmpuri pentru Clasificator',
	
	'Cimp text' => 'Cîmp text',
	'Cimp numeric' => 'Cîmp numeric',
	'Arie Text' => 'Zonă Text',
	'Selectare singulara' => 'Selectare singulară',
	'Selectare multipla' => 'Selectare multiplă',
	'Selectare' => 'Selectare',
	'Multipla' => 'Multiplă',
	'Selectare tip radio' => 'Selectare tip radio',
	'Selectare tip bifa' => 'Selectare tip bifă',
	'Selectare tip bife multiple' => 'Selectare tip bife multiple',
	'Valoare' => 'Valoare',
	'Cimp data' => 'Cîmp dată',
	'Cimp de tip Document' => 'Cîmp de tip Document',
	'Cimp de tip Clasificator' => 'Cîmp de tip Clasificator',
	'Cimp Calcul ($id1 + 10 + $id2) ($id1 ." test " . $id2)' => 'Cîmp Calcul ($id1 + 10 + $id2) ($id1 . " test " . $id2)',
	
	'Asigurati-va ca aveti permisiuni de scriere in directoriul' => 'Asigurați-vă că aveți permisiuni de scriere în directoriul',
	'Optiuni' => 'Opțiuni',
	'Adauga Atribut' => 'Adaugă Atribut',
	
	'rule' => 'Regulă',
	'actions' => 'Acțiuni',
	'create_rule' => 'Crează regulă',
	'manage_RBAC_clasificator' => 'Gestiunea Clasificatoarelor RBAC',
	'RBAC_clasificator' => 'Clasificatoare RBAC',
	
	'Ascendent' => 'Ascendent',
	'Descendent' => 'Descedent',
	'Tab Principal' => 'Tab Principal',
	
	'Numele cimpului' => 'Numele cîmpului',
	'Public' => 'Public',
	'Private' => 'Privat',
	'Vizibilitate' => 'Vizibilitate',
	'Cimp obligatoriu' => 'Cîmp obligatoriu',
	'Nume Tab' => 'Nume Tab',
	'Format cîmp' => 'Format cîmp',
	'Lungime maximă' => 'Lungime maximă',
	'Introduceti lungimea' => 'Introduceți lungimea',
	'Mod introducere date' => 'Mod introducere date',
	'Function' => 'Funcție',
	'Model' => 'Model',
	'Functie in Model' => 'Funcție în Model',
	'Introduceti Valoarea sau tastati DEL pentru a sterge cimpul' => 'Introduceți Valoarea sau tastați DEL pentru a șterge cîmpul',
	'Adaugati input sau tastati TAB din fereastra activa' => 'Adăugați input sau tastați TAB din fereastra activă',
	'Modelul de legatura' => 'Modelul de legătură',
	'-- Alegeti un Model --' => '-- Alegeți un Model --',
	'-- Alegeti o functie --' => '-- Alegeți o Funcție--',
	'Adauga Buton Creare' => 'Adaugă buton Creare',
	'Adauga Autocomplete' => 'Adaugă buton Autocompletare',
	'Cimpul de legatura' => 'Cîmpul de legătură',
	'-- Alegeti un Atribut --' => '-- Alegeți un Atribut --',
	
	'Pentru a adauga operatii' => 'Pentru a adăuga operații,',
	'introduceti semnele operative' => 'introduceți semnele operative',
	'Pentru a adauga coeficienti' => 'Pentru a adăuga coeficienți,',
	'introduceti caracterele respective.' => ' introduceți caracterele respective.',
	'Pentru a adauga o valoare statica' => 'Pentru a adăuga o valoare statică,',
	'introduceti valoarea(fara semnele operative).' => ' introduceți valoarea(fără semnele operative).',
	'Pentru concatinare' => 'Pentru concatenare,',
	'introduceti "."' => 'introduceți "."',
	'Nu introduceti textul concatinat intre ghilimele!!!' => ' Nu introduceți textul concatenat între ghilimele!!!',
	'Pentru a adauga atribute' => 'Pentru a adăuga atribute,',
	'faceti click pe atributele afisate mai jos, sau introduceti manual un nume de atributele(din acele create).' => 
			' faceți click pe atributele afișate mai jos, sau introduceți manual un nume de atribute(din cele create).',
	'Introduceti Expresia de Calcul (puteti folosi parantezele)' => 'Introduceți Expresia de Calcul (puteți folosi paranteze)',
	
	//admincl
	'create_crud' => 'Crează CRUD',
	'config_model_columns' => 'Configurarea Coloanelor',
	'admin' => 'Administrator',
	'Adăugați înregistrare nouă' => 'Adăugați înregistrare nouă',
	'Modificați înregistrare' => 'Modificați înregistrare',
	'Sistem' => 'Informație de Sistem',
	'General Info' => 'Informație Generală',
	
	




);