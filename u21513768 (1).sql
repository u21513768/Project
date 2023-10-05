-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 08:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u21513768`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbarticles`
--

CREATE TABLE `tbarticles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `article_text` varchar(10000) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbarticles`
--

INSERT INTO `tbarticles` (`article_id`, `user_id`, `title`, `description`, `author`, `date`, `article_text`, `category`) VALUES
(63, 15, 'Exploring Ancient Ruins', 'John Smith', 'A journey through the mysteries of ancient civilizations and their ruins.', '2023-08-15', 'Deep within the annals of history lie the enigmatic remnants of ancient civilizations, each whispering tales of their grandeur, wisdom, and mysteries. Embarking on a journey through these ruins, one finds themselves transported across time, delving into the secrets of bygone cultures. This expedition through the past not only unveils architectural marvels but also unravels the profound wisdom and intriguing customs of civilizations long lost to the sands of time.\r\n\r\nThe Egyptian Enigma: Pyramids and Pharaohs\r\nThe very mention of ancient civilizations conjures images of Egypt, a land adorned with awe-inspiring pyramids and guarded by enigmatic sphinxes. \r\n\r\nThe Pyramids of Giza, with their monumental size and precise engineering, have baffled historians for centuries. How did the ancient Egyptians achieve such architectural mastery without modern technology?\r\n\r\nWandering through the labyrinthine chambers of the pyramids, one cannot help but marvel at the advanced knowledge of astronomy and mathematics possessed by the Egyptians. The hieroglyphics adorning the walls tell stories of pharaohs, gods, and the afterlife, providing tantalizing glimpses into their beliefs and rituals.\r\n\r\nThe Majestic Marvels of Mesopotamia: Cradle of Civilization\r\nIn the heart of Mesopotamia, between the Tigris and Euphrates rivers, lies the cradle of civilization. Here, the Sumerians, Babylonians, and Assyrians thrived, leaving behind an extraordinary legacy. The ziggurats, towering terraced structures, served as temples and observatories, symbolizing the connection between earth and heaven.\r\n\r\nExploring the ruins of Mesopotamia, one is transported back to a time when writing systems were born, laws were codified, and complex societies flourished. The Hanging Gardens of Babylon, one of the Seven Wonders of the Ancient World, evoke a sense of wonder about the engineering prowess of ancient architects.\r\n\r\nMachu Picchu: Incan Engineering Mastery\r\nHidden amidst the Andes Mountains, Machu Picchu stands as a testament to the ingenuity of the Inca civilization. Perched atop steep cliffs, this archaeological marvel showcases the advanced engineering skills of the Incas. The precision of their stone-cutting techniques, evident in the seamless joints of massive stones, is a source of perpetual fascination.\r\n\r\nAs the mist lifts over Machu Picchu, the aura of mystery surrounding the purpose of this citadel deepens. Was it a royal estate, a religious sanctuary, or an astronomical observatory? The silence of the stones invites contemplation, urging visitors to ponder the secrets buried within the ancient Incan city.\r\n\r\nLost Cities of the Indus Valley: Mohenjo-Daro and Harappa\r\nIn the vast plains of the Indus Valley, the ruins of Mohenjo-Daro and Harappa reveal the sophistication of an ancient civilization dating back to 3300 BCE. The meticulously planned cities boasted advanced drainage systems, multi-story houses, and a hieroglyphic script yet to be fully deciphered.\r\n\r\nWalking amidst the ruins, one can sense the vibrant life that once thrived here. The Great Bath, a large public bathing area, hints at the social and ritualistic aspects of the Indus Valley people. Yet, the sudden decline and disappearance of these cities remain an unsolved enigma, leaving historians and archaeologists intrigued.\r\n\r\nIn the footsteps of explorers and adventurers, this journey through the mysteries of ancient civilizations and their ruins illuminates the depth of human ingenuity and the quest for understanding our origins. Each crumbling stone and weathered artifact tells a story, inviting us to unravel the secrets of our shared past. As we stand amidst these ruins, we are reminded that the mysteries of ancient civilizations are not lost but patiently waiting for curious souls to unveil their hidden truths.', 'Adventure'),
(64, 14, 'Cooking Adventures: International Cuisine', 'Emily Rodriguez', 'Embark on a culinary journey around the world with delightful recipes.', '2023-05-10', 'Every corner of the globe boasts a unique culinary tradition, a tapestry of flavors, aromas, and textures that reflect the rich cultural heritage of a region. Embarking on a culinary journey around the world is not merely a gastronomic experience; it\'s a voyage that tantalizes the taste buds, broadens the palate, and weaves a story of diverse traditions, passions, and the love for food. Join us as we explore delightful recipes from different corners of the world, inviting you to savor the essence of each culture through its delectable offerings.\r\n\r\nChapter 1: The Spices of India\r\nOur culinary adventure begins in the bustling markets of India, where the air is fragrant with a melange of spices. From the fiery curries of Goa to the aromatic biryanis of Hyderabad, Indian cuisine is a symphony of flavors. Try your hand at crafting the perfect butter chicken, savor the tangy goodness of dosas, and indulge in the sweetness of gulab jamun. Let the spices transport you to the colorful streets of Mumbai and the serene backwaters of Kerala.\r\n\r\nChapter 2: Pasta and Pizza in Italy\r\nNo culinary journey is complete without a stop in Italy, the birthplace of pasta and pizza. Dive into the art of pasta-making, rolling out silky sheets of dough for classic dishes like spaghetti carbonara and fettuccine Alfredo. Explore the rustic flavors of Sicilian pizzas, adorned with fresh tomatoes, basil, and mozzarella. Each bite is a testament to the Italian passion for simple, high-quality ingredients and the joy of shared meals with loved ones.\r\n\r\nChapter 3: Sushi and Sashimi in Japan\r\nCrossing continents, we arrive in Japan, where culinary artistry reaches new heights. Delight in the precision of sushi-making, where fresh fish meets vinegared rice in perfect harmony. Explore the world of sashimi, where delicate slices of raw seafood showcase the purity of flavors. From the comforting embrace of miso soup to the theatrical flair of teppanyaki, Japanese cuisine is a celebration of aesthetics and taste, inviting you to experience food as an art form.\r\n\r\nChapter 4: The Sizzle of Tex-Mex\r\nOur journey takes a spicy turn as we venture into the heart of Tex-Mex cuisine. From the sizzle of fajitas to the crunch of tacos, Tex-Mex dishes are a fiesta of flavors. Learn the secrets behind crafting the perfect guacamole and embrace the smoky allure of chipotle peppers. With bold spices, vibrant colors, and the spirit of fiesta, Tex-Mex cuisine brings the joy of celebration to your table.\r\n\r\nChapter 5: A Feast in Morocco\r\nIn the bustling souks of Morocco, the aroma of spices mingles with the lively chatter of traders. Moroccan cuisine is a fusion of savory and sweet, exemplified by the iconic tagines and couscous dishes. Discover the magic of slow-cooked meats, infused with a symphony of spices and dried fruits. Let your taste buds dance to the tune of harira, a hearty soup that warms the soul. Moroccan cuisine is a celebration of tradition, hospitality, and the art of sharing.\r\n\r\nChapter 6: Sweet Endings Around the World\r\nNo culinary journey would be complete without indulging in the world\'s sweet delights. From the flaky layers of French pastries to the rich decadence of Austrian Sachertorte, travel the globe one dessert at a time. Experience the bliss of Italian gelato, the gooey perfection of American brownies, and the delicate intricacy of Japanese mochi. Each dessert is a sweet finale, leaving a lingering taste of the global culinary adventure.\r\n\r\nEmbark on this gastronomic odyssey, where each recipe is a passport stamp, and every dish is a story waiting to be shared. Through the delightful recipes from around the world, savor the diverse cultures, traditions, and flavors that make our planet a truly delicious and interconnected global kitchen. Bon appétit, buon appetito, いただきます, ¡buen provecho! Let the culinary journey begin.', ''),
(65, 14, 'Capturing Natural Beauty', 'Michael Johnson', 'Discover the art of outdoor photography and learn to capture stunning landscapes.', '2023-05-10', 'Beyond the confines of studios and artificial lights lies a world waiting to be captured—a world where every sunrise paints the sky with hues of gold, where the dance of leaves in the wind tells a silent tale, and where rugged mountains stand tall, challenging the very essence of our existence. Outdoor photography is more than just clicking pictures; it\'s about immersing oneself in nature\'s grandeur, understanding the play of light and shadow, and preserving moments that whisper the secrets of the wild. Join us on a journey to discover the art of outdoor photography, where lenses become storytellers, and landscapes transform into masterpieces.\r\n\r\nChapter 1: The Language of Light\r\nIn the realm of outdoor photography, light is the brushstroke that paints the canvas. Explore the nuances of natural light—from the soft, golden glow of the golden hour to the dramatic contrasts of the blue hour. Learn to read the light, understand its direction, and use it to sculpt your subjects. Discover the magic of backlighting, sidelighting, and the interplay of shadows that add depth and drama to your photographs.\r\n\r\nChapter 2: Mastering Composition\r\nComposition is the soul of photography. Delve into the principles of composition, from the rule of thirds to leading lines, framing, and symmetry. Understand how the choice of focal length and perspective can create a sense of scale and proportion in your images. Learn to balance elements within the frame, allowing viewers to seamlessly navigate through your photographs. Unleash your creativity by breaking the rules and experimenting with unconventional compositions.\r\n\r\nChapter 3: Capturing Landscapes\r\nLandscape photography is an art of patience and perseverance. Discover the techniques of capturing sweeping vistas, majestic mountains, serene lakes, and rolling meadows. Learn to use wide-angle lenses to emphasize the vastness of landscapes and telephoto lenses to bring distant subjects closer. Understand the importance of foreground interest and the role of atmospheric conditions in creating mood and ambiance in your landscape photographs.\r\n\r\nChapter 4: Macro Magic in Nature\r\nZoom in on the intricate details of the natural world through macro photography. Explore the hidden universe of flora and fauna, capturing the delicate patterns on butterfly wings, the glistening dewdrops on spider webs, or the textures of leaves and petals. Master the use of macro lenses and extension tubes, understanding the importance of focus stacking and diffused lighting to create captivating close-up images.\r\n\r\nChapter 5: Photographing Wildlife\r\nWildlife photography is a dance with the unpredictable. Learn the art of patience, observation, and anticipation as you capture the untamed beauty of animals in their natural habitats. Understand animal behavior, use camouflage techniques, and practice ethical wildlife photography, ensuring minimal disturbance to the subjects. Explore the world of bird photography, tracking flight patterns and capturing fleeting moments with precision.\r\n\r\nChapter 6: Post-Processing and Storytelling\r\nPost-processing is the digital darkroom where raw images are transformed into polished masterpieces. Explore the basics of image editing, from adjusting exposure and contrast to enhancing colors and sharpening details. Dive into advanced techniques such as HDR blending and panorama stitching to create visually stunning compositions. Understand the art of storytelling through photography, curating a series of images that evoke emotions and narratives.\r\n\r\nEmbark on this photographic expedition, where each chapter is a stepping stone toward mastery. Through the lens of outdoor photography, witness the awe-inspiring beauty of the natural world and immortalize moments that echo the harmony between humanity and nature. Let your creativity roam free, capturing the essence of landscapes, the poetry of wildlife, and the intricate details of the wild. With every click, embrace the adventure of outdoor photography and let nature\'s wonders inspire your art. Happy clicking!', ''),
(66, 15, 'Fitness Journey: From Couch to Marathon', 'Jessica Williams', 'Follow the inspiring story of transforming from a couch potato to a marathon runner.', '2023-05-17', 'In the heart of every individual lies the potential for transformation, a journey that transcends physical boundaries and taps into the reservoirs of determination and resilience. This is the inspiring story of one such metamorphosis – a transformation from a sedentary lifestyle as a couch potato to the exhilarating heights of becoming a marathon runner. It\'s a narrative that proves that with unwavering dedication, anyone can rewrite their story and achieve the seemingly impossible.\r\n\r\nChapter 1: The Wake-Up Call\r\nThe story begins in the realm of comfort, where the allure of the couch and the soothing whispers of sedentary living drown the aspirations of a healthier life. But amidst the coziness, a wake-up call echoes – be it a health scare, a sudden realization, or a simple desire for change. This pivotal moment sparks the journey, serving as the catalyst for a life-altering decision.\r\n\r\nChapter 2: The First Steps\r\nWith a heart brimming with determination, our protagonist takes the first steps. The initial jog is a struggle, breaths are labored, and muscles protest. Yet, with every step, the couch potato is shedding the old self and embracing a new identity – that of a fledgling runner. It\'s a journey of self-discovery, of learning the art of persistence and setting realistic goals.\r\n\r\nChapter 3: Embracing the Challenges\r\nThe path to becoming a marathon runner is paved with challenges. There are days of sore muscles and moments of self-doubt. But our aspiring athlete refuses to succumb to adversity. With a mind strengthened by resilience and a spirit fortified by perseverance, each challenge becomes a stepping stone, propelling them closer to the finish line.\r\n\r\nChapter 4: The Support System\r\nNo journey is complete without a support system – friends, family, fellow runners, and coaches who provide encouragement, guidance, and an unwavering belief in the runner\'s potential. Their cheers echo through the trials, reminding the protagonist that they are not alone in this pursuit. Together, they transform obstacles into opportunities and setbacks into comebacks.\r\n\r\nChapter 5: The Triumph of the Finish Line\r\nAs the training intensifies, the day of the marathon arrives. Heart pounding, muscles primed, our once-couch-bound hero stands at the starting line, a testament to their determination. The race begins, and with each stride, the distance between the couch and the finish line diminishes. And then, in a glorious crescendo of effort and willpower, they cross the finish line, transforming the dream of becoming a marathon runner into a reality.\r\n\r\nChapter 6: The New Beginning\r\nThe marathon is not just a race; it\'s a metaphor for life\'s challenges. Our protagonist, now a marathon runner, understands that the journey doesn’t end at the finish line but continues in the choices they make, the goals they set, and the lives they inspire. A newfound sense of confidence radiates from within, shaping a future where every hurdle is an opportunity and every setback a lesson learned.\r\n\r\nThis story is not just about a physical transformation; it\'s about the strength of the human spirit, the power of resilience, and the triumph of the indomitable will. It stands as a beacon of hope for everyone aspiring to break free from the shackles of inertia and embark on a transformative journey. From a couch potato to a marathon runner, this tale reminds us that within us lies the strength to rewrite our story, one step at a time.', ''),
(67, 15, 'Innovations in Technology', 'Alex Turner', 'Exploring the latest technological advancements shaping our future.', '2022-09-07', 'In the ceaseless rhythm of progress, humanity has embarked on a journey that transcends the boundaries of imagination. Every day, cutting-edge technologies emerge, redefining the way we live, work, and connect with the world. From artificial intelligence that mirrors human cognition to sustainable innovations combating climate change, the latest technological advancements are not merely tools; they are the architects of our future. Join us as we delve into the realm of innovation, exploring the groundbreaking technologies that are shaping our tomorrow.\r\n\r\nChapter 1: Artificial Intelligence and Machine Learning\r\nArtificial Intelligence (AI) and Machine Learning (ML) have ceased to be the realms of science fiction. Dive into the world of neural networks, deep learning, and predictive algorithms. Explore how AI is revolutionizing industries, from healthcare and finance to entertainment and transportation. Witness the rise of intelligent machines that understand, learn, and adapt, heralding a new era of automation and innovation.\r\n\r\nChapter 2: The Internet of Things (IoT) and Smart Living\r\nThe Internet of Things has woven a digital thread into the fabric of our everyday lives. Journey into smart homes, connected devices, and IoT ecosystems. Discover how sensors, actuators, and networks converge to create seamless experiences, enhancing convenience, efficiency, and sustainability. Explore the transformative potential of IoT in agriculture, healthcare, and urban planning, ushering in an era of intelligent, interconnected living.\r\n\r\nChapter 3: Quantum Computing and the Computing Revolution\r\nQuantum Computing, the frontier of computational power, promises to solve problems deemed insurmountable by classical computers. Delve into the world of qubits, superposition, and quantum entanglement. Unravel the mysteries of quantum algorithms and their potential to revolutionize cryptography, drug discovery, and optimization challenges. Witness the dawn of a computing revolution that defies the limits of classical computation.\r\n\r\nChapter 4: Sustainable Technologies and Eco-Innovation\r\nIn the face of climate change, sustainable technologies have emerged as beacons of hope. Explore renewable energy solutions, eco-friendly materials, and circular economies. Witness the ingenuity of scientists and engineers striving for a greener future, from solar power and wind energy to bio-plastics and waste-to-energy technologies. Delve into the world of eco-innovation, where technology harmonizes with nature to preserve our planet.\r\n\r\nChapter 5: Biotechnology and Medical Breakthroughs\r\nBiotechnology has transformed the landscape of healthcare and medicine. Journey into the realms of genomics, gene editing, and personalized medicine. Explore groundbreaking therapies such as CRISPR-Cas9, immunotherapy, and regenerative medicine. Witness how biotechnology is unraveling the mysteries of genetic diseases, enabling tailored treatments, and pushing the boundaries of human longevity.\r\n\r\nChapter 6: Augmented Reality (AR) and Virtual Reality (VR)\r\nStep into the immersive worlds of Augmented Reality and Virtual Reality. Explore AR applications in education, retail, and gaming, enhancing real-world experiences with digital overlays. Dive into VR simulations that transport us to distant planets, historical events, and fantastical realms. Discover the transformative potential of AR and VR in training, therapy, and storytelling, reshaping our perception of reality.\r\n\r\nAs we venture into these technological frontiers, we find ourselves on the brink of unprecedented possibilities. Each innovation, each discovery, is a glimpse into the future—a future where challenges are met with ingenuity, where human potential knows no bounds, and where the intersection of technology and humanity paves the way for a brighter, more connected world. Join us in this exploration of the latest technological advancements, where the present converges with the future, and where the impossible becomes the blueprint for tomorrow. Welcome to the future—welcome to a world shaped by innovation.', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbfriends`
--

CREATE TABLE `tbfriends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbfriends`
--

INSERT INTO `tbfriends` (`id`, `user_id`, `follow_id`) VALUES
(6, 14, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbgallery`
--

CREATE TABLE `tbgallery` (
  `image_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `image_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbgallery`
--

INSERT INTO `tbgallery` (`image_id`, `article_id`, `image_name`) VALUES
(75, 63, 'circles.jpg'),
(76, 64, 'waves.jpg'),
(78, 66, 'splash.jpg'),
(79, 67, 'street.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblist`
--

CREATE TABLE `tblist` (
  `list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblist`
--

INSERT INTO `tblist` (`list_id`, `user_id`, `name`) VALUES
(2, 14, 'NewList1'),
(3, 14, 'NewList2');

-- --------------------------------------------------------

--
-- Table structure for table `tblisttable`
--

CREATE TABLE `tblisttable` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblisttable`
--

INSERT INTO `tblisttable` (`id`, `list_id`, `article_id`) VALUES
(2, 2, 63),
(3, 2, 66),
(4, 3, 63),
(5, 3, 64);

-- --------------------------------------------------------

--
-- Table structure for table `tbpfp`
--

CREATE TABLE `tbpfp` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbratings`
--

CREATE TABLE `tbratings` (
  `rating` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbratings`
--

INSERT INTO `tbratings` (`rating`, `user_id`, `article_id`, `id`) VALUES
(0, 13, 63, 4),
(1, 14, 63, 5),
(1, 15, 63, 6),
(1, 17, 63, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbreviews`
--

CREATE TABLE `tbreviews` (
  `review` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbreviews`
--

INSERT INTO `tbreviews` (`review`, `user_id`, `article_id`, `id`) VALUES
('sadasdasd', 14, 63, 4),
('Review', 15, 63, 5),
('I think this is great, i love it', 16, 63, 6),
('Article By Me', 17, 63, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbusers`
--

CREATE TABLE `tbusers` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(16) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbusers`
--

INSERT INTO `tbusers` (`user_id`, `username`, `name`, `surname`, `email`, `password`, `birthday`) VALUES
(14, 'Hell Yeah', 'Test Name', 'Test Surname', 'new@email.com', 'test', '2023-10-01'),
(15, 'john69', 'John', 'Doe', 'john.doe@gmail.com', 'test', '2023-10-30'),
(16, 'JaneTheMan', 'Jane', 'Jimothy', 'Jane@gmail.co.za', 'test', '2023-10-31'),
(17, 'fluffyTDS', 'Quintin', 'Hotman', 'u21513768@tuks.co.za', 'test', '2023-11-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbarticles`
--
ALTER TABLE `tbarticles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbfriends`
--
ALTER TABLE `tbfriends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`follow_id`),
  ADD KEY `tbfriends_ibfk_2` (`follow_id`);

--
-- Indexes for table `tbgallery`
--
ALTER TABLE `tbgallery`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `tblist`
--
ALTER TABLE `tblist`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblisttable`
--
ALTER TABLE `tblisttable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `tbpfp`
--
ALTER TABLE `tbpfp`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbratings`
--
ALTER TABLE `tbratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `tbreviews`
--
ALTER TABLE `tbreviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `tbusers`
--
ALTER TABLE `tbusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbarticles`
--
ALTER TABLE `tbarticles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbfriends`
--
ALTER TABLE `tbfriends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbgallery`
--
ALTER TABLE `tbgallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tblist`
--
ALTER TABLE `tblist`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblisttable`
--
ALTER TABLE `tblisttable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbpfp`
--
ALTER TABLE `tbpfp`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbratings`
--
ALTER TABLE `tbratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbreviews`
--
ALTER TABLE `tbreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbarticles`
--
ALTER TABLE `tbarticles`
  ADD CONSTRAINT `tbarticles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbfriends`
--
ALTER TABLE `tbfriends`
  ADD CONSTRAINT `tbfriends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbfriends_ibfk_2` FOREIGN KEY (`follow_id`) REFERENCES `tbusers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbgallery`
--
ALTER TABLE `tbgallery`
  ADD CONSTRAINT `tbgallery_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `tbarticles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblist`
--
ALTER TABLE `tblist`
  ADD CONSTRAINT `tblist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblisttable`
--
ALTER TABLE `tblisttable`
  ADD CONSTRAINT `tblisttable_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `tbarticles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblisttable_ibfk_3` FOREIGN KEY (`list_id`) REFERENCES `tblist` (`list_id`);

--
-- Constraints for table `tbpfp`
--
ALTER TABLE `tbpfp`
  ADD CONSTRAINT `tbpfp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`);

--
-- Constraints for table `tbratings`
--
ALTER TABLE `tbratings`
  ADD CONSTRAINT `tbratings_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `tbarticles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbreviews`
--
ALTER TABLE `tbreviews`
  ADD CONSTRAINT `tbreviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbreviews_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `tbarticles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
