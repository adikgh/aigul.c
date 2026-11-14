-- Сайт баптаулары (site) және интерфейс сөздері (word)
-- Телефон, WhatsApp, Instagram — уақытша мәндер, админ панельден/базадан өзгертіңіз.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


LOCK TABLES `site` WRITE;
INSERT INTO `site` (`id`,`site`,`name`,`phone`,`phone_view`,`whatsapp`,`whatsapp_view`,`instagram`,`telegram`,`youtube`,`tik-tok`,`metrika`,`analitics`,`pixel`,`mail`) VALUES
(1,'aigul.kz','AIGUL ASQAR','87759243907','+7 (775) 924-39-07','77082635937','+7 (708) 263-59-37','aigul_askar07',NULL,NULL,NULL,NULL,NULL,NULL,'info@aigul.kz');
UNLOCK TABLES;

LOCK TABLES `word` WRITE;
/*!40000 ALTER TABLE `word` DISABLE KEYS */;
INSERT INTO `word` VALUES
(10,'Address:','Мекен-жайы:','Адрес:'),
(14,'Your name','Сіздің атыңыз','Ваше имя'),
(15,'Your number','Cіздің нөміріңіз','Ваш номер'),
(16,'Submit your','Сұраныс қалдыру','Оставить заявку'),
(23,'Learn more','Толығырақ','Узнать подробнее'),
(27,'Close','Жабу','Закрыть'),
(34,'To get the consultation','Толық кеңес алу','Получить консультацию'),
(49,'OUR RECOMMENDATION','Наша рекомендация','Біздің ұсынысымыз'),
(54,'View all','Посмотреть все','Барлығын қарау'),
(65,'Our advantages','Біздің ерекшелігіміз','Наши преимущества'),
(69,'Write','Жазу','Написать'),
(82,'About us','Біз жайлы','О нас'),
(91,'Frequently asked Questions','Жиі қойылатын сұрақтар','Часто задаваемые вопросы'),
(96,'Get a discount','Жеңілдікті алу','Получит скидку'),
(99,'Communication','Байланысу','Связаться'),
(103,'calc_al','● Қаңырау шалыңыз, байланыста','● Звоните, мы сейчас работаем'),
(104,'order site','Тапсырыс беру','Заказать сайт'),
(105,'Developed by:','Сайтты жасаған:','Сайт разработали:'),
(108,'All rights reserved','Барлық құқықтар қорғалған','Все права защищены'),
(113,'Still have questions?','Сұрақтарыңыз бар ма?','Остались вопросы?'),
(116,'Contact','Байланыс','Контакты'),
(118,'write to us on social networks','бізге әлеуметтік желіден жазыңыз','напишите нам на соц. сетях'),
(120,'or','немесе','или'),
(145,'back','артқа','назад'),
(147,'farther','алға','далее'),
(149,'pick up','қарау','подобрать'),
(159,'days','күн','дней'),
(169,'Enter the number','Нөмеріңізді жазыңыз ..','Введите номер ..'),
(179,'Fill out the application form','Форманы толтырыңыз','Заполните форму заявки'),
(181,'loading','жүктелуде','загрузка'),
(188,'discuss the project','жобаны талқылау','обсудить проект'),
(199,'month','ай','мес'),
(200,'tenge/month','теңге/ай','тенге/мес'),
(201,'tenge','теңге','тенге'),
(202,'for services per week','аптасына','на услуги в неделю'),
(203,'for services per day','күніне','на услуги в день'),
(204,'applications','сұраныс','заявок'),
(205,'orders','тапсырыс','заказов'),
(213,'Need a consultation?','Консультация қажет пе?','Нужно консультация?'),
(214,'Fill out the form and we will contact you shortly','Форманы толтырыңыз, сізге өзіміз <br/>қабарласатын боламыз','Заполните форму и мы свяжемся <br>с вами в ближайшее время'),
(217,'Menu','Мәзір','Меню'),
(218,'Services','Қызметтер','Услуги'),
(219,'Language','Тіл','Язык'),
(220,'Sales department','Сату бөлімі','Отдел продаж'),
(221,'Clients','Клиенттер','Клиенты'),
(222,'Team','Команда','Команда'),
(224,'To order','Тапсырыс беру','Заказать'),
(225,'More','Толығырақ','Подробнее'),
(228,'Our works','Біздің жұмыстарымыз','Познакомьтесь с нашими работами'),
(230,'Frequently asked Questions','Жиі қойылатын сұрақтар','Часто задаваемые вопросы'),
(236,'If you have any questions, write us WhatsApp','Егер басқада сұрақтарың болса <br>WhatsApp желісіне жаза аласың','Если у вас есть какие-либо вопросы, <br>напишите нам WhatsApp'),
(239,'Let`s discuss it','Давайте талқылайық','Давайте его обсудим'),
(240,'Send a request','Жазбаны жіберу','Отправить заявку'),
(241,'Describe the task','Тапсырманы сипаттап көріңіз','Опишите задачу'),
(243,'Payment for ','Төлем ','Оплата на '),
(244,' days',' күнге',' дней'),
(248,'Free consultation','Тегін кеңес алу','Бесплатная консультация'),
(256,'View','Қарау','Смотреть'),
(257,'Contact via WhatsApp','WhatsApp арқылы байланысу','Связаться через WhatsApp'),
(258,'Do I want this too?','Мен де осындай қалаймын?','Я тоже хочу такое?'),
(265,'tg','тг','тг'),
(266,'from','','от'),
(272,'Exact cost','Нақты бағасы','Точная стоимость'),
(273,'Sales department','Сату бөлімі','Отдел продаж'),
(275,'Not sure which is right for you?','Сізге қайсысы сәйкес келетініне сенімді емессіз бе?','Не знаете, что вам подойдёт?'),
(276,'Call us by phone or write to messengers. We will discuss and advise.','Бізге телефон арқылы хабарласыңыз немесе хабаршыларға жазыңыз. Біз талқылап, кеңес береміз.','Позвоните нам по телефону или напишите <br>в мессенджеры. Обсудим и подскажем.'),
(277,'Call #gprog','#gprog-қа қоңырау шалу','Позвонить в #gprog'),
(278,'Contact via Telegram','Telegram арқылы байланысу','Связаться через Telegram'),
(279,'Write a message','Жазу','Написать'),
(292,'Design of houses and apartments on a turnkey basis of premium class','Премиум класстағы үйлер мен пәтерлерді жобалау.','Проектирование домов и квартир под ключ премиум - класса.'),
(293,'About','Біз жайлы','О нас'),
(294,'Projects','Жобалар','Проекты'),
(295,'Price','Бағасы','Цены'),
(296,'Exit','Шығу','Выйти'),
(297,'From design to implementation and field supervision: we work without patterns and boundaries','Жобалаудан іске асыруға дейін және авторлық қадағалау: шексіз және шаблонсыз жұмыс жасаймыз.','От проектирования до реализации и авторского надзора: работаем без шаблонов и границ.'),
(298,'Sign up for a free consultation and start discussing your project today','Тегін кеңес алу үшін тіркеліп, бүгіннен қалдырмай жобаңызды талқылаңыз','Запишитесь на бесплатную консультацию и начните обсуждать ваш проект уже сегодня'),
(299,'Leave a request','Жазба қалдыру','Оставьте заявку'),
(300,'Our projects','Біздің жобалар','Наши проекты'),
(301,'All projects','Барлық жобалар','Все проекты'),
(302,'Design with meaning','Мағыналы дизайн','Дизайн <br> со смыслом'),
(303,'Completed projects','Жасалған жобалар','Реализованные проекты'),
(304,'Made in #gprog','#gprog-та жасалған','Сделано в #gprog'),
(305,'digital for business','digital cіздің<br>бизнесіңізге','digital для<br>бизнеса'),
(306,'We are on social media:','Біздің әлеуметтік желілеріміз:','Мы в cоциальных сетях:'),
(307,'Republic of Kazakhstan, Almaty city, st. Bayzakov, 28','Қазақстан Республикасы, Алматы қаласы, <br>көш. Байзақов, 28','​Республика Казахстан, г. Алматы <br>ул. Байзакова, 28'),
(308,'Mon-Fri from 08:00 to 17:00 <br> Sat-Sun Day off','Дс-Жм 08:00-ден 17:00-ге дейін <br>Сб-Жб Демалыс','Пн-Пт с 08:00 до 17:00 <br>Сб-Вс Выходной'),
(309,'Write your data below','Төменге деректеріңізді жазыңыз','Напишите ниже ваше данный'),
(310,'Send','Жіберу','Отправить'),
(311,'\"Great design begins with an even greater story.\"','«Тамаша дизайн өте үлкен оқиғадан басталады».','«Великий дизайн начинается с еще более великой истории».'),
(312,'it is a team that is not afraid of difficult tasks, we are inspired by interesting projects.','бұл қиын тапсырмалардан қорықпайтын команда, бізді қызықты жобалар шабыттандырады.','это команда которая не боится сложных задач, нас вдохновляют интересные проекты.'),
(313,'Our studio was founded in 2011. We have been creating unique interiors for our clients for 10 years. During this time, we have developed 150 projects in the field of design and engineering.','Біздің студия 2011 жылы құрылған. 10 жыл бойы клиенттерімізге бірегей интерьерлер жасап келеміз. Осы уақыт ішінде жобалау және инжиниринг саласында 150-ден аса жобаларды жасадық.','Наша студия основана в 2011 году. Создаем уникальные интерьеры для наших клиентов уже 10 лет. За это время мы разработали 150 проектов в сфере дизайна и проектирования.'),
(314,'Design studio \"BTS Architect\" offers exclusive project ideas to make your apartment unique, the style of which will reflect your personality and impeccable taste.','«BTS Architect» дизайнерлік студиясы сіздің пәтеріңізді бірегей ету үшін эксклюзивті жоба идеяларын ұсынады, оның стилі сіздің тұлғалық және мінсіз талғамыңызды көрсетеді.','Студия дизайна \"BTS Architect\" предлагает эксклюзивные идеи для проектов, чтобы сделать вашу квартиру уникальной, стиль которой будет отражать вашу индивидуальность и безупречный вкус.'),
(315,'We specialize in modern-style business and premium class interiors and know everything about modern technologies and materials. We design all over the world.','Біз заманауи стильдегі бизнес және премиум класс интерьерлерінің маманымыз және заманауи технологиялар мен материалдар туралы бәрін білеміз. Біз бүкіл әлем бойынша дизайн жасаймыз.','Мы специализируемся на интерьерах бизнес и премиум класса в современном стиле и знаем все о современных технологиях и материалах. Проектируем по всему миру.'),
(316,'Come to us to make your dreams of your best home come true!','Өз үйіңіз жайлы армандарыңызды жүзеге асыру үшін бізге келіңіз!','Приходите к нам воплощать мечты о Вашем лучшем доме!'),
(317,'How we are working','Біз қалай жұмыс жасаймыз','Как мы работаем'),
(318,'We are confident in the professionalism of our team, and our projects exceed the expectations of even the most sophisticated clients.','Біз өз командамыздың кәсібилігіне сенімдіміз және біздің жобаларымыз тіпті ең күрделі клиенттердің үмітінен де асып түседі.','Мы уверены в профессионализме своей команды, а наши проекты превосходят ожидания даже самых искушенных клиентов.'),
(319,'Do you want to join us?','Бізге қосылғың келе ме?','Хотите к нам?'),
(320,'Leave a request and get advice from the best team of specialists','Өтініш қалдырыңыз және ең жақсы мамандар тобынан кеңес алыңыз','Оставь заявку и получи консультацию у лучшей команды специалистов'),
(321,'Founder','Негізін қалаушы','Основатель'),
(322,'Select the type of object:','Объектінің түрін таңдаңыз:','Выберите тип объекта:'),
(323,'House, apartment, apartment','Үй, пәтер, сәулетті үйлер','Дом, квартира, апартаменты'),
(324,'Administrator premises or office','Әкімшілік, үй-жай немесе кеңсе','Aдминистр. помещение или офис'),
(325,'Public space, ferret, retail, showroom, salon','Қоғамдық кеңістік, хорека, ритейл, көрме залы, салон','Общественное пространство, хорека, ритейл, шоурум, салон'),
(326,'Indicate the area of ​​your project','Жобаңыздың аймағын көрсетіңіз','Укажите площадь вашего проекта'),
(327,'Package contents:','Пакет құрамы:','Состав пакета:'),
(328,'Example','Мысал','Пример'),
(329,'The cost of your project:','Сіздің жобаңыздың құны:','Стоимость вашего проекта:'),
(330,'Choose','Таңдау','Выбирать'),
(331,'Our services','Біздің қызметтеріміз','Наши услуги'),
(332,'We are a full cycle company','Біз толық циклді компаниямыз','Мы — компания полного цикла');
/*!40000 ALTER TABLE `word` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `word_block` WRITE;
/*!40000 ALTER TABLE `word_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `word_block` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

