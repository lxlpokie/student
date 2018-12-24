/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : student

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-07-12 20:09:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for student_admin
-- ----------------------------
DROP TABLE IF EXISTS `student_admin`;
CREATE TABLE `student_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_name` (`admin_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_admin
-- ----------------------------
INSERT INTO `student_admin` VALUES ('1', 'super', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `student_admin` VALUES ('2', '小刚', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `student_admin` VALUES ('3', '小红', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `student_admin` VALUES ('4', '小白', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `student_admin` VALUES ('14', '小刚子', '25d55ad283aa400af464c76d713c07ad');

-- ----------------------------
-- Table structure for student_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `student_auth_group`;
CREATE TABLE `student_auth_group` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of student_auth_group
-- ----------------------------
INSERT INTO `student_auth_group` VALUES ('1', '学院管理员', '1', '17,19,18,21');
INSERT INTO `student_auth_group` VALUES ('4', '课程管理员', '1', '5,21,22');

-- ----------------------------
-- Table structure for student_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `student_auth_group_access`;
CREATE TABLE `student_auth_group_access` (
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `student_auth_group_access_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `student_admin` (`admin_id`) ON DELETE CASCADE,
  CONSTRAINT `student_auth_group_access_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `student_auth_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_auth_group_access
-- ----------------------------
INSERT INTO `student_auth_group_access` VALUES ('2', '1');
INSERT INTO `student_auth_group_access` VALUES ('4', '1');
INSERT INTO `student_auth_group_access` VALUES ('4', '4');

-- ----------------------------
-- Table structure for student_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `student_auth_rule`;
CREATE TABLE `student_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_auth_rule
-- ----------------------------
INSERT INTO `student_auth_rule` VALUES ('17', '院系管理', '院系管理', '1', '1', '', '0');
INSERT INTO `student_auth_rule` VALUES ('4', '教师管理', '教师管理', '1', '1', '', '0');
INSERT INTO `student_auth_rule` VALUES ('5', '课程管理', '课程管理', '1', '1', '', '0');
INSERT INTO `student_auth_rule` VALUES ('6', '学生管理', '学生管理', '1', '1', '', '0');
INSERT INTO `student_auth_rule` VALUES ('19', 'College/collegeadd', '添加学院', '1', '1', '', '17');
INSERT INTO `student_auth_rule` VALUES ('18', 'College/collegelist', '院系列表', '1', '1', '', '17');
INSERT INTO `student_auth_rule` VALUES ('22', 'Course/courselist', '添加课程', '1', '1', '', '5');
INSERT INTO `student_auth_rule` VALUES ('21', 'Index/index', '首页', '1', '1', '', '0');
INSERT INTO `student_auth_rule` VALUES ('20', 'Department/departmentadd', '添加系', '1', '1', '', '18');

-- ----------------------------
-- Table structure for student_classes
-- ----------------------------
DROP TABLE IF EXISTS `student_classes`;
CREATE TABLE `student_classes` (
  `classes_id` int(11) NOT NULL AUTO_INCREMENT,
  `classes_name` varchar(255) DEFAULT NULL,
  `classes_num` varchar(13) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `classes_enter_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`classes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_classes
-- ----------------------------
INSERT INTO `student_classes` VALUES ('14', '软件一班', '1000101021701', '8', '2017');
INSERT INTO `student_classes` VALUES ('15', '软件二班', '1000101021702', '8', '2017');

-- ----------------------------
-- Table structure for student_classes_copy
-- ----------------------------
DROP TABLE IF EXISTS `student_classes_copy`;
CREATE TABLE `student_classes_copy` (
  `classes_id` int(11) NOT NULL AUTO_INCREMENT,
  `classes_name` varchar(255) DEFAULT NULL,
  `classes_num` varchar(13) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `classes_enter_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`classes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_classes_copy
-- ----------------------------
INSERT INTO `student_classes_copy` VALUES ('12', '应用技术一班', '1000101011701', '7', '2017');
INSERT INTO `student_classes_copy` VALUES ('13', '应用技术二班', '1000101011702', '7', '2017');
INSERT INTO `student_classes_copy` VALUES ('14', '软件一班', '1000101021701', '8', '2017');
INSERT INTO `student_classes_copy` VALUES ('15', '软件二班', '1000101021702', '8', '2017');

-- ----------------------------
-- Table structure for student_classes_course
-- ----------------------------
DROP TABLE IF EXISTS `student_classes_course`;
CREATE TABLE `student_classes_course` (
  `classes_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_classes_course
-- ----------------------------

-- ----------------------------
-- Table structure for student_college
-- ----------------------------
DROP TABLE IF EXISTS `student_college`;
CREATE TABLE `student_college` (
  `college_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_name` varchar(255) DEFAULT NULL,
  `college_num` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_college
-- ----------------------------
INSERT INTO `student_college` VALUES ('3', '计算机学院', '1000101');
INSERT INTO `student_college` VALUES ('4', '物理学院', '1000102');
INSERT INTO `student_college` VALUES ('5', '数学院', '1000103');
INSERT INTO `student_college` VALUES ('6', '外国语学院', '1000104');

-- ----------------------------
-- Table structure for student_college1
-- ----------------------------
DROP TABLE IF EXISTS `student_college1`;
CREATE TABLE `student_college1` (
  `college_id` int(22) NOT NULL AUTO_INCREMENT,
  `college_name` varchar(255) DEFAULT NULL,
  `college_pid` int(11) DEFAULT NULL,
  `college_num` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_college1
-- ----------------------------
INSERT INTO `student_college1` VALUES ('2', '经济学院', '0', '02');
INSERT INTO `student_college1` VALUES ('3', '数学院', '0', '03');
INSERT INTO `student_college1` VALUES ('4', '物理学院', '0', '04');
INSERT INTO `student_college1` VALUES ('5', '化学院', '0', '05');
INSERT INTO `student_college1` VALUES ('6', '商学院', '0', '06');
INSERT INTO `student_college1` VALUES ('7', '马克思主义学院', '0', '07');
INSERT INTO `student_college1` VALUES ('10', '应用物理', '4', '01');
INSERT INTO `student_college1` VALUES ('11', '理论物理', '4', '02');
INSERT INTO `student_college1` VALUES ('12', '无线电物理', '4', '03');

-- ----------------------------
-- Table structure for student_course
-- ----------------------------
DROP TABLE IF EXISTS `student_course`;
CREATE TABLE `student_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_course
-- ----------------------------
INSERT INTO `student_course` VALUES ('10', '数据结构', '3');
INSERT INTO `student_course` VALUES ('11', '计算机网络', '3');
INSERT INTO `student_course` VALUES ('15', '大学英语一上', '6');

-- ----------------------------
-- Table structure for student_department
-- ----------------------------
DROP TABLE IF EXISTS `student_department`;
CREATE TABLE `student_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) DEFAULT NULL,
  `department_num` varchar(9) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_department
-- ----------------------------
INSERT INTO `student_department` VALUES ('7', '计算机应用技术', '100010101', '3');
INSERT INTO `student_department` VALUES ('8', '软件工程', '100010102', '3');

-- ----------------------------
-- Table structure for student_module
-- ----------------------------
DROP TABLE IF EXISTS `student_module`;
CREATE TABLE `student_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) DEFAULT NULL,
  `module_pid` int(11) DEFAULT NULL,
  `module_status` tinyint(1) DEFAULT '1' COMMENT '0:不启用;1:启用',
  `module_icon` varchar(255) DEFAULT NULL,
  `module_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_module
-- ----------------------------
INSERT INTO `student_module` VALUES ('1', '院系管理', '0', '1', ' icon-book ', null);
INSERT INTO `student_module` VALUES ('2', '院系列表', '1', '1', null, 'college/collegelist');
INSERT INTO `student_module` VALUES ('3', '教师管理', '0', '1', ' icon-briefcase ', null);
INSERT INTO `student_module` VALUES ('4', '教师列表', '3', '1', null, 'teacher/teacherlist');
INSERT INTO `student_module` VALUES ('5', '添加学院', '1', '1', null, 'college/collegeadd');
INSERT INTO `student_module` VALUES ('6', '添加教师', '3', '1', null, 'teacher/teacheradd');
INSERT INTO `student_module` VALUES ('8', '课程管理', '0', '1', 'icon-tasks', null);
INSERT INTO `student_module` VALUES ('9', '课程列表', '8', '1', null, 'course/courselist');
INSERT INTO `student_module` VALUES ('10', '添加课程', '8', '1', null, 'course/courseadd');
INSERT INTO `student_module` VALUES ('11', '学生管理', '0', '1', 'icon-user', null);
INSERT INTO `student_module` VALUES ('12', '添加学生', '11', '1', null, 'student/studentadd');
INSERT INTO `student_module` VALUES ('13', '学生列表', '11', '1', null, 'student/studentlist');
INSERT INTO `student_module` VALUES ('14', '权限管理', '0', '1', 'icon-cog', null);
INSERT INTO `student_module` VALUES ('15', '添加规则', '14', '1', null, 'rights/ruleadd');
INSERT INTO `student_module` VALUES ('16', '规则列表', '14', '1', null, 'rights/rulelist');
INSERT INTO `student_module` VALUES ('17', '添加用户组', '14', '1', null, 'rights/groupadd');
INSERT INTO `student_module` VALUES ('18', '用户组列表', '14', '1', null, 'rights/grouplist');
INSERT INTO `student_module` VALUES ('19', '添加管理员', '14', '1', null, 'rights/adminadd');
INSERT INTO `student_module` VALUES ('20', '管理员列表', '14', '1', null, 'rights/adminlist');
INSERT INTO `student_module` VALUES ('21', '模块管理', '0', '1', 'icon-desktop', null);
INSERT INTO `student_module` VALUES ('22', '模块列表', '21', '1', null, 'module/modulelist');
INSERT INTO `student_module` VALUES ('23', '添加模块', '21', '1', null, 'module/moduleadd');

-- ----------------------------
-- Table structure for student_party
-- ----------------------------
DROP TABLE IF EXISTS `student_party`;
CREATE TABLE `student_party` (
  `party_id` int(11) NOT NULL AUTO_INCREMENT,
  `party_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`party_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_party
-- ----------------------------
INSERT INTO `student_party` VALUES ('1', '中共党员');
INSERT INTO `student_party` VALUES ('2', '中共预备党员');
INSERT INTO `student_party` VALUES ('3', '共青团员');
INSERT INTO `student_party` VALUES ('4', '群众');
INSERT INTO `student_party` VALUES ('5', '民革');
INSERT INTO `student_party` VALUES ('6', '民盟');
INSERT INTO `student_party` VALUES ('7', '民建');
INSERT INTO `student_party` VALUES ('8', '民进');
INSERT INTO `student_party` VALUES ('9', '农工党');
INSERT INTO `student_party` VALUES ('10', '致公党');
INSERT INTO `student_party` VALUES ('11', '九三学社');
INSERT INTO `student_party` VALUES ('12', '台盟');

-- ----------------------------
-- Table structure for student_score
-- ----------------------------
DROP TABLE IF EXISTS `student_score`;
CREATE TABLE `student_score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `score` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`score_id`),
  UNIQUE KEY `course_id` (`course_id`,`student_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `student_score_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `student_course` (`course_id`) ON DELETE CASCADE,
  CONSTRAINT `student_score_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_student` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_score
-- ----------------------------
INSERT INTO `student_score` VALUES ('32', '11', '3', '80');
INSERT INTO `student_score` VALUES ('33', '11', '2', '70');
INSERT INTO `student_score` VALUES ('37', '10', '2', '70');
INSERT INTO `student_score` VALUES ('38', '10', '3', '80');

-- ----------------------------
-- Table structure for student_student
-- ----------------------------
DROP TABLE IF EXISTS `student_student`;
CREATE TABLE `student_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_num` varchar(15) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_sex` varchar(255) DEFAULT NULL,
  `student_home` varchar(255) DEFAULT NULL,
  `student_address` varchar(255) DEFAULT NULL,
  `student_IDcard` varchar(255) DEFAULT NULL,
  `student_thumb` varchar(255) DEFAULT NULL,
  `party_id` varchar(255) DEFAULT NULL,
  `student_birth` varchar(255) DEFAULT NULL,
  `classes_id` int(11) DEFAULT NULL,
  `student_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `classes_id` (`classes_id`),
  CONSTRAINT `student_student_ibfk_1` FOREIGN KEY (`classes_id`) REFERENCES `student_classes` (`classes_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_student
-- ----------------------------
INSERT INTO `student_student` VALUES ('1', '100010102170101', '小明', '男', '河北雄安', '河北省雄安新区恒大土豪城', '110110110911911911', '\\student\\public\\uploads\\student\\1000101\\100010102\\1000101021701\\100010102170101.jpeg', '3', '199901', '14', null);
INSERT INTO `student_student` VALUES ('2', '100010102170102', '喜羊羊', '男', '青青草原羊村', '青青草原羊村公寓1号', '110110110911911910', '\\student\\public\\uploads\\student\\1000101\\100010102\\1000101021701\\100010102170102.png', '4', '200003', '14', null);
INSERT INTO `student_student` VALUES ('3', '100010102170103', '小刚', '男', '北京东城', '北京市东城区110号', '110110911911123456', '\\student\\public\\uploads\\student\\1000101\\100010102\\1000101021701\\100010102170103.jpg', '2', '199909', '14', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for student_teacher
-- ----------------------------
DROP TABLE IF EXISTS `student_teacher`;
CREATE TABLE `student_teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(255) DEFAULT NULL,
  `teacher_thumb` varchar(255) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL COMMENT '教师所属学院',
  `title_id` int(11) DEFAULT NULL COMMENT '教师职称',
  `teacher_password` varchar(255) NOT NULL DEFAULT '123456',
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_teacher
-- ----------------------------
INSERT INTO `student_teacher` VALUES ('7', '扎克伯格', '\\student\\public\\uploads\\teacher\\thumb\\20170629\\70ec68bbeb636e6a91164c04acb37691.jpg', '3', '4', '123456');
INSERT INTO `student_teacher` VALUES ('16', '玛丽', '\\student\\public\\uploads\\teacher\\thumb\\20170628\\aebf99060ea820d3f4b9aa66da1530a3.jpg', '6', '2', '123456');
INSERT INTO `student_teacher` VALUES ('17', '刘诗诗', '\\student\\public\\uploads\\teacher\\thumb\\20170628\\94f4e6e0464feeadf4ce25642ed23277.jpg', '6', '4', '123456');
INSERT INTO `student_teacher` VALUES ('18', '古力娜扎', '\\student\\public\\uploads\\teacher\\thumb\\20170628\\e0bc87cd2ce08130394acbd3a9ed7338.jpg', '6', '1', '123456');
INSERT INTO `student_teacher` VALUES ('19', '马化腾', '\\student\\public\\uploads\\teacher\\thumb\\20170629\\a53abf66c88a1109f03aa30679d8f551.jpg', '3', '1', '123456');
INSERT INTO `student_teacher` VALUES ('20', '雷军', '\\student\\public\\uploads\\teacher\\thumb\\20170630\\d4581fdc2f8c23d18d737bb54ac8150b.jpg', '3', '4', '123456');
INSERT INTO `student_teacher` VALUES ('21', '比尔盖茨', '\\student\\public\\uploads\\teacher\\thumb\\20170630\\0cf33acd8513cf053d5f3faa917965bd.jpg', '3', '4', '123456');

-- ----------------------------
-- Table structure for student_teachercourse
-- ----------------------------
DROP TABLE IF EXISTS `student_teachercourse`;
CREATE TABLE `student_teachercourse` (
  `teachercourse_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`teachercourse_id`),
  UNIQUE KEY `teacher_id` (`teacher_id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `student_teachercourse_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `student_teacher` (`teacher_id`) ON DELETE CASCADE,
  CONSTRAINT `student_teachercourse_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `student_course` (`course_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_teachercourse
-- ----------------------------
INSERT INTO `student_teachercourse` VALUES ('1', '19', '10');
INSERT INTO `student_teachercourse` VALUES ('2', '19', '11');

-- ----------------------------
-- Table structure for student_teachercourse_classes
-- ----------------------------
DROP TABLE IF EXISTS `student_teachercourse_classes`;
CREATE TABLE `student_teachercourse_classes` (
  `teachercourse_id` int(11) NOT NULL,
  `classes_id` int(11) NOT NULL,
  UNIQUE KEY `teachercourse_id` (`teachercourse_id`,`classes_id`),
  KEY `teachercourse_id_2` (`teachercourse_id`),
  CONSTRAINT `student_teachercourse_classes_ibfk_1` FOREIGN KEY (`teachercourse_id`) REFERENCES `student_teachercourse` (`teachercourse_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_teachercourse_classes
-- ----------------------------
INSERT INTO `student_teachercourse_classes` VALUES ('1', '14');
INSERT INTO `student_teachercourse_classes` VALUES ('1', '15');
INSERT INTO `student_teachercourse_classes` VALUES ('2', '14');

-- ----------------------------
-- Table structure for student_title
-- ----------------------------
DROP TABLE IF EXISTS `student_title`;
CREATE TABLE `student_title` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_title
-- ----------------------------
INSERT INTO `student_title` VALUES ('1', '助教');
INSERT INTO `student_title` VALUES ('2', '讲师');
INSERT INTO `student_title` VALUES ('3', '副教授');
INSERT INTO `student_title` VALUES ('4', '教授');
INSERT INTO `student_title` VALUES ('5', '其他');
