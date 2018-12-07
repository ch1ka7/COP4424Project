-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2018 at 12:33 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author_id`, `comment`, `date`) VALUES
(12, 1, 1, 'Scams in this decade are very prevalent, unfortunately preying on the kind and naive. The blog above is unfortunately pretty accurate. The CNN article I found on a more general note had an entire list of the worst 50 charities distinguished by the percentage falsely promised to go to the cause. This link [http://www.tampabay.com/americas-worst-charities/ ] will take you directly to this list.\r\n“Using state and federal records, the Times and CIR identified nearly 6,000 charities that have chosen to pay for-profit companies to raise their donations……The 50 worst charities in America devote less than 4% of donations raised to direct cash aid. Some charities gave even less. Over a decade, one diabetes charity raised nearly $14 million and gave about $10,000 to patients. Six spent no cash at all on their cause.”', '2018-12-06 07:09:03'),
(13, 1, 2, 'Scams in this decade are very prevalent, unfortunately preying on the kind and naive. The blog above is unfortunately pretty accurate. The CNN article I found on a more general note had an entire list of the worst 50 charities distinguished by the percentage falsely promised to go to the cause. This link [http://www.tampabay.com/americas-worst-charities/ ] will take you directly to this list.\r\n“Using state and federal records, the Times and CIR identified nearly 6,000 charities that have chosen to pay for-profit companies to raise their donations……The 50 worst charities in America devote less than 4% of donations raised to direct cash aid. Some charities gave even less. Over a decade, one diabetes charity raised nearly $14 million and gave about $10,000 to patients. Six spent no cash at all on their cause.”', '2018-12-06 12:11:29'),
(18, 2, 1, 'Nice!', '2018-12-06 19:48:59'),
(21, 7, 1, 'Scams in this decade are very prevalent, unfortunately preying on the kind and naive. The blog above is unfortunately pretty accurate. The CNN article I found on a more general note had an entire list of the worst 50 charities distinguished by the percentage falsely promised to go to the cause. ', '2018-12-06 23:24:25'),
(22, 7, 1, 'These foundations use familiar sounding names of popular legitimate charity in order to mislead contributors in thinking it is another organization. The disturbing parallel to ‘Make-a-Wish Foundation’ and the fake sound alike charities has caused many people to call and complain to Make-a-Wish Foundation. These sound a like’s include “Kids Wish Network, Children’s Wish Foundation International and Wishing Well Foundation. All of the names sound like the original, Make-A-Wish, which does not hire professional telemarketers.”\r\nSomething to think about though, there is something no one can steal, which is your time. Giving to a cause with your hands on help, like packing a book bag with materials and supplies for a child going back to school. These things, mostly local, are contributing in a way that reaches the ones closest to you, the members of your community. ', '2018-12-06 23:24:51'),
(23, 6, 1, 'Proper execution of corporate social responsibility stands to offer positive global impacts, but also serves as a form of brand-building that has become increasingly popular. The rise in consumers looking for green brands, or brands that align with various other causes, has led many companies to strongly market their sudden good intentions.', '2018-12-06 23:25:16'),
(24, 6, 1, 'While practicing social responsibility is rarely profitable in the same way as cheap production and low wage costs, it pays in other areas of the business. Claiming to sell a lifelong product could increase the company’s market share or initial sales enough to make it worth discontinuing past tactics of planned obsolescence—at least for a time. Similarly, a company switching to a more environmentally-friendly method of production may choose to absorb the resulting costs in favor of a more positive brand image. Though this does defy capitalist practices of the past, which relied on repeated sales with low costs, the public’s current interest in socially responsible businesses makes it an appealing strategy for the homo economicus model.', '2018-12-06 23:25:41'),
(25, 6, 1, 'This is a very well written post, my compliments. If we take for granted the United States’ effect on the global economy, it is easy to use our domestic housing crisis, and the policies created because of it, as a way to measure the adverse effects that accumulating debt has on a large scale. I like the way you used refinancing property mortgages (of which our debt is secured against) to refinancing a nation’s debt as a whole. One of your quotes mentions that in America, giving tax incentives on mortgages is seen as a human right, which to me, states that owning a home in America is seen as part of the larger “American Dream”. We haven’t delved too deeply into this topic in class discussions, but this really is an interesting note to make about the societal beliefs that are partly responsible for the housing crisis.', '2018-12-06 23:25:57'),
(26, 5, 1, 'So… What is the answer to this question? How do we make sure that something like this does not happen again? To be sure, it wasn’t just the social status that comes from owning a home that led to families buying homes they couldn’t afford. It was a combination of many things, including: speculative housing buying for investing under the belief that housing prices would only go up, not to mention the underlying capitalist greed where lenders could essentially backtrack on their agreements and not have to worry because houses are the perfect collateral when loaning money. In class recently, we started discussing Keynesianism in economics, and while I’m still not 100% clear on what it is as an economic theory, I do understand that it involves heavier government regulation in the economy, which is needed. Leaving the market to itself will clearly not create equilibrium, because capitalists are only interested in making money.', '2018-12-06 23:26:17'),
(27, 7, 2, 'I see the direction that the group behind the app was going in, but the concept is not entirely new, only in the sense that it is an app and uses more modern technology. For years there have existed games and websites that provide questionnaires that end with a list of jobs that could potentially fit the individual’s personality. I remember taking a mandatory one in high school- my recommended field of study was aviation, very unexpected but rather interesting. If the purpose of the app is geared towards recommending certain fields of study/jobs, I’m certain it would become popular. Look at Buzzfeed, for example. There are a multitude of quizzes that people have created, ranging from “What country they should live in?!” to “What kind of Disney princess are you?” Although they may sound silly, these quizzes are actually impressively common because people enjoy taking them; much is the same with taking psychological personality tests.', '2018-12-06 23:29:32'),
(28, 6, 2, 'I see the direction that the group behind the app was going in, but the concept is not entirely new, only in the sense that it is an app and uses more modern technology. For years there have existed games and websites that provide questionnaires that end with a list of jobs that could potentially fit the individual’s personality. I remember taking a mandatory one in high school- my recommended field of study was aviation, very unexpected but rather interesting. If the purpose of the app is geared towards recommending certain fields of study/jobs, I’m certain it would become popular. Look at Buzzfeed, for example. There are a multitude of quizzes that people have created, ranging from “What country they should live in?!” to “What kind of Disney princess are you?” Although they may sound silly, these quizzes are actually impressively common because people enjoy taking them; much is the same with taking psychological personality tests.', '2018-12-06 23:29:43'),
(29, 6, 2, 'The pymetrics system app could very well be useful if it was used by students seeking employment because it could provide options that they had not considered yet.', '2018-12-06 23:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `tag` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `title`, `content`, `tag`, `date`) VALUES
(1, 1, '\r\nTaiwan-based travel startup AsiaYo raises $7M Series B led by Alibaba Taiwan Entrepreneurs Fund', 'AsiaYo, a travel accommodation booking platform based in Taipei, Taiwan, has raised a $7 million Series B led by Alibaba Taiwan Entrepreneurs Fund, a non-profit initiative run by the Chinese e-commerce giant, and China Development Financial. Darwin Ventures and Delta Ventures also participated in the round, which brings AsiaYo’s  total raised since its launch in 2014 to $10 million, including a $3 million Series A.\r\n\r\nFounded by CEO C.K. Cheng, AsiaYo has grown over the past four years to a team of about 100 people and now claims about 300,000 members on its site. In addition to Taiwan, the platform also operates in Japan, Korea, Hong Kong, and Thailand, and says overseas bookings account for 60% of its business. AsiaYo’s new funding will be used to launch in new markets, with operations in Singapore and Malaysia and a new Japanese website slated to launch next year. Cheng told TechCrunch that it picked Singapore and Malaysia as its newest markets because of the amount of travel between the two countries, which are next to one another.\r\n\r\nAsiaYo works with 50 partners, including Hong Kong Airlines, KKday, and Rakuten LIFULL STAY, to provide reward programs and deals on vacation bookings. The website is currently available in English, Chinese, and Korean and claims 60,000 listings across 60 cities. The startup targets younger tourists traveling within Asia with what it calls “hyper-personalized journeys” created with the help of its AI-based algorithm AYSort, which analyzes user behavior to provide booking suggestions.\r\n\r\nIn a press statement, Alibaba Taiwan Entrepreneurs Fund executive director Andrew Lee said “With rapid economic development across Asia, we have seen a significant rise in inter-regional tourism. AsiaYo has capitalized on this trend, demonstrating its growth potential. We’re currently working with AsiaYo to further develop technological capabilities in the travel industry.”\r\n\r\nAsiaYo’s listings include a combination of rooms, apartments, hostels, and hotels, which means it competes against a wide variety of other accommodation booking sites, like Airbnb, Agoda, and HotelQuickly. The startup differentiates, however, by verifying listings with landlords before they go live for quality assurance and to “inspire travelers to step out of their comfort zone,” said Cheng. The company also provides multi-lingual customer support through several channels, including Line, Facebook, WeChat, and its own helplines.', 'Technology', '2018-12-06 07:03:49'),
(2, 1, '\r\nNetflix rival Iflix launches $5M search for up-and-coming filmmakers in Asia', 'Netflix  is increasing its efforts in Asia after it commissioned more local content and began testing more aggressive price points, but one local rival is hitting back with a program to spotlight promising creators in the region.\r\n\r\nMalaysia-headquartered Iflix, which operates in 26 countries across Africa, the Middle East and Asia, today announced a $5 million program to find 30 filmmakers across four of its largest markets: Indonesia, Malaysia, Bangladesh, and the Philippines. The company, which has raised nearly $300 million from investors that include Sky, offers a freemium service with a paid tier that costs around $3 per month. It claims an audience of ‘millions’ of users.\r\n\r\nThe twelve-month initiative will be run alongside Next 10 Ventures,  a digital content program from ex-YouTube exec Benjamin Grubbs, with the aim of helping would-be or part-time filmmakers to fully pursue their passion.\r\n\r\n“There’s ad revenue in some markets but it may not be sufficient enough to enable you to have a full-time career,” Grubbs, who was previously YouTube’s global director of top creator partnerships, told TechCrunch in an interview. “A commitment up front to support creative storytellers is a positive element fo the ecosystem… there are things people want to do without waiting for brand sponsorship.”\r\n\r\nIn addition to financing, the program will provide mentoring, equipment and other assistance to produce content exclusively for Iflix.\r\n\r\nIflix launched its own original content program 18 months ago, and Craig Galvin — the company’s global head of content — said that the initiative isn’t just limited to creators’ local markets, which might be a logical assumption given Netflix’s more global approach.\r\n\r\nInstead, Galvin — who launched Iflix’s first short-form video program earlier this year — argued that there is the potential to reach Iflix’s global viewers.\r\n\r\n“We do see our pathway to be more local-centric but I do believe some of this content will travel well beyond their territories,” he told TechCrunch.\r\n\r\n“For many, the remuneration isn’t quite there yet,” Galvin added. “So for us, it’s allowing them some scope to help reach their full potential.”\r\n\r\nThe short videos supported by the program won’t be quite as brief as the seconds-long shorts you’ll find on TikTok,  the fast-growing video platform, since Galvin and Grubbs are seeking more episodic content. However, they remain open to “exploring experimentation” — potentially series of one-minute shorts — if such proposals are judged to resonate with audiences.\r\n\r\n“There’s no definitive number but we’re expecting around 1,500 pieces of content as part of this program,” Galvin said, adding that he hopes to expand the program to cover more, or all, of Iflix’s markets in the future.\r\n\r\nFilmmakers wanting to apply to the program can do so on the website here.\r\n\r\nOne obvious comparison to the Iflix initiative is Viddsee, a Singapore-based streaming service that features short video content from independent filmmakers in Asia and beyond.\r\n\r\nFounded in 2012, Viddsee has raised a little over $2 million to date and it recently introduced a crowdfunding feature that allows filmmakers to raise money directly from its global audience. The company has also helped filmmakers to find brand sponsors in order to get the checks required to fund production.', 'Technology', '2018-12-06 07:05:15'),
(5, 1, 'Climate change: Warming made UK heatwave 30 times more likely', 'Climate change has significantly boosted the chances of having summer heatwaves in the UK.\r\n\r\nA Met Office study says that the record-breaking heat seen in 2018 was made about 30 times more likely because of emissions from human activity.\r\n\r\nWithout warming the odds of a UK heatwave in any given year were less than half a percent.\r\n\r\nBut a changing climate means this has risen to 12%, or about once every eight years.\r\n\r\nGreenhouse gas levels at new record high\r\n\'Trump effect\' limits action on climate\r\nClimate change: Where we are in seven charts\r\nThe blazing summer of 2018 was the joint warmest for the UK,\r\n\r\nIt tied with 1976, 2003 and 2006 for being the highest since records began in 1910.\r\n\r\nThe steep temperatures that sustained across most parts of the UK, peaked on July 27 when 35.6C was recorded at Felsham in Suffolk.\r\n\r\nNow researchers have analysed the observed data using climate models that can simulate the world with or without the impact of fossil fuel emissions.\r\n\r\nAnnouncing their findings at global climate talks in Katowice, Poland, UK Met Office researchers said that the impact of global warming on the hot summer were significant.\r\n\r\n\"Climate change has made the heatwave we had this summer much more likely, about 30 times more likely than it would have been had we not changed our climate through our emissions of greenhouse gases,\" said Prof Peter Stott, from the Met Office who carried out the analysis.\r\n\r\n\"If we look back over many centuries, we can see that the summer like 2018 was a very rare event before the industrial revolution when we started pumping out greenhouse gases into the atmosphere.\"', 'Global Warming', '2018-12-06 23:16:10'),
(6, 1, 'Fossil preserves \'sea monster\' blubber and skin', 'Scientists have identified fossilised blubber from an ancient marine reptile that lived 180 million years ago.\r\n\r\nBlubber is a thick layer of fat found under the skin of modern marine mammals such as whales.\r\n\r\nIts discovery in this ancient \"sea monster\" - an ichthyosaur - appears to confirm the animal was warm-blooded, a rarity in reptiles.\r\n\r\nThe preserved skin is smooth, like that of whales or dolphins. It had lost the scales characteristic of its ancestors.\r\n\r\nThe ichthyosaur\'s outer layer is still somewhat flexible and retains evidence of the animal\'s camouflage pattern.\r\n\r\nThe reptile was counter-shaded - darker on the upper side and light on the underside. This counter-balances the shading effects of natural light, making the animal more difficult to see.\r\n\r\n\"Ichthyosaurs are interesting because they have many traits in common with dolphins, but are not at all closely related to those sea-dwelling mammals,\" said co-author Mary Schweitzer, professor of biological sciences at North Carolina State University (NCSU).\r\n\r\nTheir similar appearance suggests that ichthyosaurs and whales evolved similar strategies to adapt to marine life - an example of convergent evolution.\r\n\r\nProf Schweitzer said: \"They have many features in common with living marine reptiles like sea turtles, but we know from the fossil record that they gave live birth, which is associated with warm-bloodedness.\"\r\n\r\nMost reptiles today are cold-blooded, meaning their body temperature is determined by the warmth of their surroundings. Blubber helps some marine animals maintain a high body temperature regardless of the ocean water temperature.\r\n\r\nCo-author Johan Lindgren, from Lund University in Sweden, told BBC News: \"Blubber is found in living marine mammals but notably also adult individuals of the leatherback sea turtle. Its primary role in all of these animals seems to be insulation, and the leatherback is unique in many aspects.', 'Fish', '2018-12-06 23:17:19'),
(7, 1, 'Stock markets stabilise after earlier sell-off', 'US markets stabilised on Thursday after steep falls earlier in the day spurred by fears about US-China trade tensions and global growth.\r\n\r\nThe Dow Jones index closed down about 0.3% while the S&P 500 slipped less than 0.2%.\r\n\r\nThe tech-focused Nasdaq even ventured into positive territory, ending 0.4% higher.\r\n\r\nThe rebound followed sharp falls in Europe and extended the sharp market swings seen in recent weeks.\r\n\r\nIn London the FTSE 100 tumbled 3.2%, or more than 200 points, to close around 6,700 - its lowest level in two years.\r\n\r\nFalls on European markets were even steeper, with Paris and Frankfurt both shedding almost 3.5%.\r\n\r\nOil prices also sank, with Brent crude more than 3% lower.\r\n\r\nAnalysts said the arrest of Chinese telecoms giant Huawei\'s chief financial officer in Canada had revived worries over the US\'s trade war with China.', 'Business', '2018-12-06 23:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `email`) VALUES
(1, 1, 'Admin', '8cb2237d0679ca88db6464eac60da96345513964', 'a@a.com'),
(2, 2, 'User', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'u@u.com'),
(3, 2, 'Cengiz', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'b@b.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
