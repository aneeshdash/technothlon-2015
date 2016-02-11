<?php

    define('ROLL_NUMBER_LENGTH', 9);
    define('DEBUG', false);
    abstract class MarkingScheme
    {
        protected $marks = [];
        protected $questions;
        protected $maxMarks;

        function __construct($questions, $maxMarks)
        {
            $this->questions = $questions;
            $this->maxMarks  = $maxMarks;
        }


        abstract public function getMarks($answers);

        public function getMarksList()
        {
//            print_r($this->marks);
            return $this->marks;
        }

        /**
         * @return mixed
         */
        public function getMaxMarks()
        {
            return $this->maxMarks;
        }
    }

    abstract class BettingScheme
    {
        protected $questions;

        function __construct($questions)
        {
            $this->questions = $questions;
        }

        abstract public function getMarks($answers, $maxMarks);
    }

    class BettingScheme1 extends BettingScheme
    {
        function __construct($questions)
        {
            parent::__construct($questions);
        }

        public function getMarks($answers, $maxMarks)
        {
            $all = true;
            foreach ($this->questions as $question) {
                if ($answers[$question] !== true) {
                    $all = false;
                    break;
                }
            }
            return $all ? 0.2 * $maxMarks : -0.3 * $maxMarks;
        }
    }

    class MarkingSchemeType1 extends MarkingScheme
    {
        function __construct($questions, $maxMarks)
        {
            parent::__construct($questions, $maxMarks);
        }

        public function getMarks($answers)
        {
            $marks = 0;
            foreach ($this->questions as $question) {
                if ($answers[$question] === true) {
                    $this->marks[$question] = 2.5;
                    $marks += 2.5;
                } else {
                    $this->marks[$question] = 0;
                }
            }
            return $marks;
        }
    }

    class MarkingSchemeType2 extends MarkingScheme
    {
        function __construct($questions, $maxMarks)
        {
            parent::__construct($questions, $maxMarks);
        }

        public function getMarks($answers)
        {
            $marks = 0;
            foreach ($this->questions as $question) {
                if ($answers[$question] === true) {
                    $this->marks[$question] = 4;
                    $marks += 4;
                } else {
                    if ($answers[$question] === false) {
                        $this->marks[$question] = -1;
                        $marks += -1;
                    } else {
                        $this->marks[$question] = 0;
                    }
                }
            }
            return $marks;
        }
    }

    class MarkingSchemePuzzles1 extends MarkingScheme
    {
        function __construct($questions, $maxMarks)
        {
            parent::__construct($questions, $maxMarks);
        }

        public function getMarks($answers)
        {
            $marks = 0;
            $rules = [
                1 => [2, 0],
                2 => [3, -1],
                3 => [4, -2],
                4 => [5, -3],
                5 => [6, -4],
                6 => [7, -5]
            ];
            $i     = 1;
            foreach ($this->questions as $question) {
                if ($answers[$question] === true) {
                    $this->marks[$question] = $rules[$i][0];
                    $marks += $rules[$i][0];
                    $i++;
                } else {
                    if ($answers[$question] === false) {
                        $this->marks[$question] = $rules[$i][1];
                        $marks += $rules[$i][1];
                        $i = 1;
                    } else {
                        $this->marks[$question] = 0;
                        $i                      = 1;
                    }
                }
            }
            return $marks;
        }
    }

    class TechnothlonEvaluator
    {
        protected static $keys;
        protected static $solutions;

        protected $questions = array();

        /**
         * @param mixed $solutions
         */
        public static function setSolutions($solutions)
        {
            self::$solutions = $solutions;
        }

        /**
         * @param mixed $keys
         */
        public static function setKeys($keys)
        {
            self::$keys = self::getCSVData($keys);
        }

        /**
         * @return array
         */
        public function getAnswers()
        {
            return $this->answers;
        }

        /**
         * @return mixed
         */
        public function getCentreNumber()
        {
            return $this->centreNumber;
        }

        /**
         * @return string
         */
        public function getCity()
        {
            return $this->city;
        }

        /**
         * @return string
         */
        public function getFilename()
        {
            return $this->filename;
        }

        /**
         * @return mixed
         */
        public function getPhone()
        {
            return $this->phone;
        }

        /**
         * @return mixed
         */
        public function getRoll()
        {
            return $this->roll;
        }

        /**
         * @return string
         */
        public function getSquad()
        {
            return $this->squad;
        }

        protected $answers = array();
        protected $betting = array();
        protected $markingScheme = array();
        protected $centreNumber;
        protected $roll;
        protected $city;
        protected $filename;
        protected $squad;
        protected $phone;
        protected $marks = 0;
        protected $marksList = [];
        protected $bettingMarks = [];

        /**
         * @var array
         */
        protected static $markingSchemers = array();
        /**
         * @var BettingScheme[]
         */
        protected static $betters = array();

        public function __construct($data)
        {
            $data = TechnothlonEvaluator::getPairs(TechnothlonEvaluator::getCSVData($data));
            $this->loadQuestions($data);
            $this->loadBetting($data);
            $this->loadMarkingScheme($data);

            $this->roll         = $data['Roll'];
            $this->phone        = $data['Mobile'];
            // $this->centreNumber = $data['Centre'];
            print_r($data);
            // $temp        = explode('\\', $data['Filepath']);
            // $this->city  = trim($temp[3]);
            // $this->squad = trim(strtoupper($temp[2]));
            // array_shift($temp);
            // array_shift($temp);
            // $this->filename = implode('/', $temp) . '/' . $data['Filename1'];
            $this->validateRollNumber();
            $this->validatePhoneNumber();
        }

        protected static function getCSVData($data)
        {
            return str_getcsv($data);
        }

        protected static function getPairs($data)
        {
            $pairs = array();
            for ($i = 0; $i < count(TechnothlonEvaluator::$keys) && $i < count($data); ++$i) {
                $pairs[TechnothlonEvaluator::$keys[$i]] = $data[$i];
            }
            return $pairs;
        }

        protected function loadQuestions($questions)
        {
            $this->questions = array();
            foreach ($questions as $question => $answer) {
                if (1 === preg_match('/Q[0-9]+/', $question)) {
                    $this->questions[intval(substr($question, 1))] = intval($answer);
                }
            }
            ksort($this->questions);
        }

        protected function loadBetting($questions)
        {
            $this->betting = array();
            foreach ($questions as $question => $answer) {
                if (1 === preg_match('/B[0-9]+/', $question)) {
                    $this->betting[intval(substr($question, 1))] = intval($answer);
                }
            }
            ksort($this->betting);
        }

        protected function loadMarkingScheme($questions)
        {
            $this->markingScheme = array();
            foreach ($questions as $question => $answer) {
                if (1 === preg_match('/M[0-9]+/', $question)) {
                    $this->markingScheme[intval(substr($question, 1))] = intval($answer);
                }
            }
            ksort($this->markingScheme);
        }

        protected function checkAnswers()
        {
            foreach ($this->questions as $question => $answer) {
                $this->answers[$question] = $this->check(
                    $answer,
                    TechnothlonEvaluator::$solutions[$question]
                );
            }
        }

        public function hasErrors()
        {
            return $this->error_roll_number_format || $this->error_roll_number_length || $this->error_phone_number;
        }

        protected $error_roll_number_length = false;
        protected $error_phone_number = false;
        protected $error_roll_number_format = false;

        public function validateRollNumber()
        {
            if (strlen($this->roll) !== ROLL_NUMBER_LENGTH) {
                $this->error_roll_number_length = true;
            }

            if (!(1 === preg_match('/[12][01][0-9]{7}/', $this->roll))) {
                $this->error_roll_number_format = true;
            }

            return $this->error_roll_number_length || $this->error_roll_number_format;
        }

        public function validatePhoneNumber()
        {
            if (strlen($this->phone) !== 10) {
                $this->error_phone_number = true;
            }
            return $this->error_phone_number;
        }

        public function __toString()
        {
            $string = '';
            $string .= 'Roll Number: ' . $this->roll . PHP_EOL .
                'Ph.: ' . $this->phone . PHP_EOL .
                'Centre: ' . $this->centreNumber . PHP_EOL .
                'City: ' . $this->city . PHP_EOL .
                'Squad: ' . $this->squad . PHP_EOL .
                'Filename: ' . $this->filename . PHP_EOL;

            $string .= 'Questions: [';
            foreach ((array)$this->questions as $no => $ans) {
                $string .= "{$no}: {$ans}, ";
            }
            $string .= ']' . PHP_EOL . 'Betting: [';
            foreach ((array)$this->betting as $no => $ans) {
                $string .= "{$no}: {$ans}, ";
            }
            $string .= ']' . PHP_EOL . 'Marking Scheme: [';
            foreach ((array)$this->markingScheme as $no => $ans) {
                $string .= "{$no}: {$ans}, ";
            }
            $string .= ']' . PHP_EOL . 'Errors: [';
            foreach ((array)$this->errors as $no => $ans) {
                $string .= "{$no}: {$ans}, ";
            }
            $string .= ']' . PHP_EOL;
            return $string;
        }

        protected function check($value, $solution)
        {
            if (0 === $value) {
                return 0;
            }

            if (is_numeric($solution)) {
                return $value === intval($solution);
            }

            if (is_array($solution)) {
                foreach ($solution as $sol) {
                    if ($value === intval($sol)) {
                        return true;
                    }
                }
                return false;
            }

            if ($solution instanceof Closure) {
                return $solution($value);
            }

            return false;
        }

        protected function calcMarks()
        {
            $marksList = [];
            $analysis  = [];
            $marks     = 0;

            foreach (self::$markingSchemers as $schemeId => $scheme) {
                if (is_array($scheme)) {
                    $choose              = isset($this->markingScheme[$schemeId]) ? ($this->markingScheme[$schemeId] === 1 || $this->markingScheme[$schemeId] === 2 ? $this->markingScheme[$schemeId] : 1) : 1;
                    $analysis[$schemeId] = $choose;
                    $marks += $scheme[$choose]->getMarks($this->answers);
                    $marksList += $scheme[$choose]->getMarksList();
                } else {
                    if ($scheme instanceof MarkingScheme) {
                        $marks += $scheme->getMarks($this->answers);
                        $marksList += $scheme->getMarksList();
                    } else {
                        throw new Exception('Unkown type');
                    }
                }
            }

            ksort($marksList);

            foreach ($this->betting as $betId => $betting) {
                if (2 === $betting) {
                    $m = self::$betters[$betId]->getMarks(
                        $this->answers,
                        self::$markingSchemers[$betId][$analysis[$betId]]->getMaxMarks()
                    );

                    $this->bettingMarks[] = $m;
                    $marks += $m;
                } else {
                    $this->bettingMarks[] = 0;
                }
            }

            if (DEBUG) {
                $last = 0;
                for ($i = 1; $i <= count($marksList); ++$i) {
                    if (isset($analysis[$i])) {
                        $last = $analysis[$i];
                    }
                    echo $i . ': ' . ($this->answers[$i] === true ? 'correct' : ($this->answers[$i] === false ? 'wrong  ' : 'skiped ')) . ' ' . $marksList[$i] . ' Scheme: ' . $last . PHP_EOL;
                }
            }
            $this->marks     = $marks;
            $this->marksList = $marksList;
            return $marks;
        }

        public function get($type = false)
        {
            $this->calcMarks();
            return $type === true ? $this->getDAT(',') : $this->getDAT(' ');
        }

        protected function getDAT($delim = ' ')
        {
            $data   = [
                $this->roll,
                $this->phone,
                $this->squad,
                $this->city,
                $this->filename,
                $this->marks,
                $this->error_roll_number_length ? 'Y' : 'N',
                $this->error_roll_number_format ? 'Y' : 'N',
                $this->error_phone_number ? 'Y' : 'N'
            ];
            $string = '';
            $string .= implode($delim, $data) . $delim . implode($delim, $this->questions) . $delim;
            $data = [];
            foreach ($this->answers as $answer) {
                $data[] = ($answer === true) ? 'C' : ($answer === false ? 'W' : 'S');
            }
            $string .= implode($delim, $data) . $delim;
            $data = [];
            foreach ($this->betting as $betting) {
                $data[] = ($betting === 2) ? 'Y' : 'N';
            }
            $string .= implode($delim, $data) . $delim;
            $data = [];
            foreach ($this->markingScheme as $scheme) {
                $data[] = $scheme;
            }
            $string .= implode($delim, $data) . $delim;
            $data = [];
            foreach ($this->marksList as $mark) {
                $data[] = $mark;
            }
            $string .= implode($delim, $data) . $delim;
            $string .= implode($delim, $this->bettingMarks) . PHP_EOL;
            return $string;
        }
    }

    // [Roll Phone Squad City File Marks] [Error] Response Correctness Betting Marking Marks Marks-from-betting
    //              6                        3        26        26        3       8      26           3
    //              6                        9        35        61       64      72      98         101
    class HautsTechnothlonEvaluator extends TechnothlonEvaluator
    {
        public function __construct($data)
        {
            parent::__construct($data);

            $this->checkAnswers();

            self::$markingSchemers = [
                1  => [1 => new MarkingSchemeType1([1, 2], 5), 2 => new MarkingSchemeType2([1, 2], 8)],
                3  => [1 => new MarkingSchemeType1([3, 4, 5], 7.5), 2 => new MarkingSchemeType2([3, 4, 5], 12)],
                6  => [1 => new MarkingSchemeType1([6, 7], 5), 2 => new MarkingSchemeType2([6, 7], 8)],
                8  => new MarkingSchemePuzzles1([8, 9, 10, 11, 12, 13], 0),
                14 => [
                    1 => new MarkingSchemeType1([14, 15, 16], 7.5),
                    2 => new MarkingSchemeType2([14, 15, 16], 12)
                ],
                17 => [
                    1 => new MarkingSchemeType1([17, 18, 19], 7.5),
                    2 => new MarkingSchemeType2([17, 18, 19], 12)
                ],
                20 => [1 => new MarkingSchemeType1([20], 2.5), 2 => new MarkingSchemeType2([20], 4)],
                21 => [
                    1 => new MarkingSchemeType1([21, 22, 23], 7.5),
                    2 => new MarkingSchemeType2([21, 22, 23], 12)
                ],
                24 => [
                    1 => new MarkingSchemeType1([24, 25, 26], 7.5),
                    2 => new MarkingSchemeType2([24, 25, 26], 12)
                ]
            ];

            self::$betters = [
                3  => new BettingScheme1([3, 4, 5]),
                17 => new BettingScheme1([17, 18, 19]),
                24 => new BettingScheme1([24, 25, 26])
            ];
        }
    }

    // [Roll Phone Squad City File Marks] [Error] Response Correctness Betting Marking Marks Marks-from-betting
    //              6                        3        25        25        3       8      25           3
    //              6                        9        34        59       62      70      95          98
    class JuniorTechnothlonEvaluator extends TechnothlonEvaluator
    {
        public function __construct($data)
        {
            parent::__construct($data);

            $this->checkAnswers();

            self::$markingSchemers = [
                1  => [1 => new MarkingSchemeType1([1, 2, 3], 7.5), 2 => new MarkingSchemeType2([1, 2, 3], 12)],
                4  => [1 => new MarkingSchemeType1([4, 5], 5), 2 => new MarkingSchemeType2([4, 5], 8)],
                6  => [1 => new MarkingSchemeType1([6, 7], 5), 2 => new MarkingSchemeType2([6, 7], 8)],
                8  => new MarkingSchemePuzzles1([8, 9, 10, 11], 0),
                12 => [1 => new MarkingSchemeType1([12], 5), 2 => new MarkingSchemeType2([12], 8)],
                13 => [1 => new MarkingSchemeType1([13, 14, 15], 7.5), 2 => new MarkingSchemeType2([13, 14, 15], 12)],
                16 => [
                    1 => new MarkingSchemeType1([16, 17, 18], 7.5),
                    2 => new MarkingSchemeType2([16, 17, 18], 12)
                ],
                19 => [1 => new MarkingSchemeType1([19, 20, 21], 7.5), 2 => new MarkingSchemeType2([19, 20, 21], 12)],
                22 => [
                    1 => new MarkingSchemeType1([22, 23, 24, 25], 10),
                    2 => new MarkingSchemeType2([22, 23, 24, 25], 16)
                ]
            ];

            self::$betters = [
                13  => new BettingScheme1([13, 14, 15]),
                19 => new BettingScheme1([19, 20, 21]),
                22 => new BettingScheme1([22, 23, 24, 25])
            ];
        }
    }

    class KvJuniorTechnothlonEvaluator extends TechnothlonEvaluator
    {
        public function __construct($data)
        {
            parent::__construct($data);

            $this->checkAnswers();

            self::$markingSchemers = [
                1  => [1 => new MarkingSchemeType1([1, 2, 3], 7.5), 2 => new MarkingSchemeType2([1, 2, 3], 12)],
                4  => [1 => new MarkingSchemeType1([4, 5, 6], 7.5), 2 => new MarkingSchemeType2([4, 5, 6], 12)],
                7  => new MarkingSchemePuzzles1([7, 8, 9, 10, 11, 12], 0),
                13 => [1 => new MarkingSchemeType1([13, 14], 5), 2 => new MarkingSchemeType2([13, 14], 8)],
                16 => [
                    1 => new MarkingSchemeType1([15, 16, 17], 7.5),
                    2 => new MarkingSchemeType2([15, 16, 17], 12)
                ],
                18 => [1 => new MarkingSchemeType1([18, 19, 20, 21], 10), 2 => new MarkingSchemeType2([18, 19, 20, 21], 16)],
            ];

            self::$betters = [
                1  => new BettingScheme1([1, 2, 3]),
                18 => new BettingScheme1([18, 19, 20, 21])
            ];
        }
    }

    class KvHautsTechnothlonEvaluator extends TechnothlonEvaluator
    {
        public function __construct($data)
        {
            parent::__construct($data);

            $this->checkAnswers();

            self::$markingSchemers = [
                1  => [1 => new MarkingSchemeType1([1, 2, 3], 7.5), 2 => new MarkingSchemeType2([1, 2, 3], 12)],
                4  => [1 => new MarkingSchemeType1([4, 5, 6], 7.5), 2 => new MarkingSchemeType2([4, 5, 6], 12)],
                7  => new MarkingSchemePuzzles1([7, 8, 9, 10, 11, 12], 0),
                13 => [1 => new MarkingSchemeType1([13, 14, 15], 7.5), 2 => new MarkingSchemeType2([13, 14, 15], 12)],
                16 => [
                    1 => new MarkingSchemeType1([16, 17, 18], 7.5),
                    2 => new MarkingSchemeType2([16, 17, 18], 12)
                ],
                18 => [1 => new MarkingSchemeType1([19, 20, 21, 22], 10), 2 => new MarkingSchemeType2([19, 20, 21], 16)],
            ];

            self::$betters = [
                1  => new BettingScheme1([1, 2, 3]),
                16 => new BettingScheme1([16, 17, 18])
            ];
        }
    }

    $i = 0;

    $juniors_key = [
        1  => 3,
        2  => 2,
        3  => 4,
        4  => 2,
        5  => 3,
        6  => 4,
        7  => 1,
        8  => 4,
        9  => 1230,
        10 => 4,
        11 => 1,
        12 => 9,
        13 => 4,
        14 => 4,
        15 => 1,
        16 => 2,
        17 => [1, 3],
        18 => 2,
        19 => 4,
        20 => 4,
        21 => 4,
        22 => function ($value) {
                return true;
            },
        23 => 4,
        24 => 1,
        25 => 2
    ];

    $hauts_key = [
        1  => 2,
        2  => function ($value) {
                return true;
            },
        3  => 3,
        4  => 3,
        5  => 2,
        6  => 2,
        7  => 2,
        8  => 43,
        9  => 182,
        10 => 3,
        11 => 4,
        12 => 4,
        13 => 80,
        14 => 2,
        15 => [1, 3],
        16 => 2,
        17 => 2,
        18 => 1,
        19 => 3,
        20 => 3,
        21 => 4,
        22 => 4,
        23 => 1,
        24 => 4,
        25 => 4,
        26 => 4
    ];

    $kv_hauts_key = [
    1=>3,2=>1,3=>3,4=>1,5=>4,6=>2,7=>1,8=>1,9=>3,10=>4,11=>1,12=>4,13=>2,14=> [1,3], 15=>2,16=>4,17=>4,18=>4,19=>function() {return true;},
    20=>4, 21=>1, 22=>2
    ];

    $kv_junior_key = [
    	1=>1,2=>2,3=>4,4=>1,5=>1,6=>1,7=>3,8=>3,9=>4,10=>3,11=>3,12=>4,13=>3,14=>1,15=>4,16=>4,17=>1,18=>function(){return true;},
    	19=>4,20=>1,21=>2
    ];
    TechnothlonEvaluator::setSolutions($hauts_key);
    $file = fopen('/Users/x/Desktop/hauts-4.csv', 'r');
    $i    = 0;
    if ($file) {
        while (($data = fgets($file, 8192)) !== false) {
            if (0 === $i) {
                TechnothlonEvaluator::setKeys($data);
            } else {
                $ele    = new HautsTechnothlonEvaluator($data);
                $result = $ele->get(true);
                echo $result;
            }
            $i++;
        }
        fclose($file);
    }