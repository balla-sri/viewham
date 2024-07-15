INSERT INTO laravel_viewham.`industries`(`industry`, `status`, `created_at`, `updated_at`) 
SELECT SDESC, 2, NOW(), NOW() FROM viewhamm.`vh_master_data` WHERE `REFGRP` = 'INDSTY';


INSERT INTO laravel_viewham.`skills`(`skill`, `status`, `created_at`, `updated_at`) 
SELECT SDESC, 2, NOW(), NOW() FROM viewhamm.`vh_master_data` WHERE `REFGRP` = 'SKILL';

INSERT INTO laravel_viewham.`tags`(`tag_name`, `slug`, `created_at`, `updated_at`) 
SELECT vh_tags.name, vh_tags.slug, NOW(), NOW() FROM viewhamm.vh_tags;


INSERT INTO laravel_viewham.`ideas`(`id`, `idea_title`, `description`, `industry`, `currency`, `min_investment`, `max_investment`, `returns_type`, `min_returns`, `max_returns`, `breakeven_type`, `min_breakeven`, `max_breakeven`, `posted_by`, `status`, `created_at`, `updated_at`) 		 
SELECT ID, IDEA_TITLE, DESCRIPTION, 
(SELECT REFID FROM viewhamm.vh_master_data WHERE viewhamm.vh_master_data.ID = viewhamm.vh_idea_hub.INDUSTRY) as INDUSTRY, 
(SELECT id FROM laravel_viewham.currencies WHERE laravel_viewham.currencies.notation = viewhamm.vh_idea_hub.currency) as currency,
MIN_INVESTMENT, MAX_INVESTMENT, 
(CASE
WHEN RETURNS_TYPE = 'Daily' THEN 1 
WHEN RETURNS_TYPE = 'Weekly' THEN 2
WHEN RETURNS_TYPE = 'Monthly' THEN 3
ELSE 4
END) as returns_type,
MIN_RETURNS, MAX_RETURNS, 
(CASE
WHEN BREAKEVEN_TYPE = 'Days' THEN 1 
WHEN BREAKEVEN_TYPE = 'Months' THEN 2
ELSE 3
END) as breakeven_type,
MIN_BREAKEVEN, MAX_BREAKEVEN, POSTED_BY, status, POSTED_DATE, NOW()  
from viewhamm.vh_idea_hub

-----START RAVIKUMAR PULUSU-------

CREATE TABLE `vh_coins` (
  `id` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `txn_id` mediumtext NOT NULL,
  `source` mediumtext NOT NULL,
  `remark` mediumtext NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `vh_coins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vh_coins`
--
ALTER TABLE `vh_coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;





CREATE TABLE `vh_posts` (
  `p_id` int(11) NOT NULL,
  `skill` varchar(111) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `association` varchar(100) NOT NULL,
  `location` longtext NOT NULL,
  `currency` varchar(100) NOT NULL,
  `price_per` varchar(111) NOT NULL,
  `min_budget` varchar(100) NOT NULL,
  `max_budget` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `nature` varchar(100) NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `post_type` varchar(100) NOT NULL,
  `create_date` varchar(100) NOT NULL,
  `modified_date` varchar(100) NOT NULL,
  `investment_currency` varchar(100) NOT NULL,
  `min_invest` varchar(100) NOT NULL,
  `max_invest` varchar(100) NOT NULL,
  `share_currency` varchar(100) NOT NULL,
  `min_share` varchar(100) NOT NULL,
  `max_share` varchar(100) NOT NULL,
  `portfolio` varchar(111) NOT NULL,
  `competitive` varchar(1111) NOT NULL,
  `l_term_work_option` int(11) NOT NULL,
  `min_as_employee` int(111) NOT NULL,
  `max_as_employee` int(111) NOT NULL,
  `min_as_partner` int(111) NOT NULL,
  `max_as_partner` int(111) NOT NULL,
  `language` varchar(111) NOT NULL,
  `candidate` varchar(111) NOT NULL,
  `mobile` int(115) NOT NULL,
  `mediate_type` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vh_posts`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vh_posts`
--
ALTER TABLE `vh_posts`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vh_posts`
--
ALTER TABLE `vh_posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;


CREATE TABLE `vh_notification` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `created_on` varchar(111) NOT NULL,
  `skill_type` varchar(111) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `c_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `vh_notification`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `vh_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

CREATE TABLE `vh_outsource_work` (
  `id` int(11) NOT NULL,
  `industry` int(11) NOT NULL,
  `description` varchar(1111) NOT NULL,
  `location` varchar(11111) NOT NULL,
  `currency_type` varchar(111) NOT NULL,
  `min_invest` int(11) NOT NULL,
  `max_invest` int(11) NOT NULL,
  `duration_type` varchar(111) NOT NULL,
  `duration_min` int(11) NOT NULL,
  `duration_max` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `publish_start_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `update_on` varchar(1111) NOT NULL,
  `create_date` varchar(1111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `vh_outsource_work`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `vh_outsource_work`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

----- END RAVIKUMAR PULUSU -------