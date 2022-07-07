<?php
	 
	namespace src\logic;

    use Firebase\JWT\JWT as FirebaseJWT;
	use Firebase\JWT\Key;
	use src\logic;
    use src\model;
	
    class JWT {

        private $isValid;
		private $token;
		
		public function __construct($jwt) {
            $publicKey = <<<EOD
			-----BEGIN PUBLIC KEY-----
			MIIBojANBgkqhkiG9w0BAQEFAAOCAY8AMIIBigKCAYEAtm/3pRDvrprj+AC4UrRx
			tvXminqrrDbckLPRkSOJJkBcN7XYAYCT2UKQk6Bnmhza+DDgfA/UiEnF6fSgQwCY
			f09O7TwOCh3qOx6i9T64+GyEBquHh/AmHozQGtD62lAfei9fk8TcKd60sqo2ZgO0
			ssXP4HPAX/Z1bp7z5NneQrfIYtdYia0/uDmHrFuVOT3iXcnr4b78n0t+lrDmqAVz
			ynk68RZgeKy6xSLTIEo3U0BbISZ3/VfBrNurrRLLQ9+d3XS+J59zQ1ptvOZk8KiD
			GReKoC3dG174Laiye1bZEx7eS8fYHegY0q62iLP/hVaxcVjZaLHfgtphSw6tafYD
			eElxV3E5YtP5RJcHcOoxjnbeF3nMU35vS41UGEePss5enlIO56mY+1Fmycxp7pQE
			DzKXgCFWBe4HkdihWLmg+CkD8JcVmHBPmRaxCLtc1ldI08rTvxkrHlpBQJoLTxc8
			2k2o1k4vc58uP2RsG+EF82EeVSCsTACSdUjhpzfCYwANAgMBAAE=
			-----END PUBLIC KEY-----
			EOD;
            try {
                $firebaseJwtDecode = FirebaseJWT::decode($jwt, new Key($publicKey, "RS256"));
				$this->token = new model\Token($firebaseJwtDecode);
				$this->isValid = true;
            } catch (\Throwable $throwable) {
                $this->isValid = false;
            }
		}
		
		public static function create($payload) {
            $privateKey = <<<EOD
			-----BEGIN RSA PRIVATE KEY-----
			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
			-----END RSA PRIVATE KEY-----
			EOD;
            $firebaseJwtEncode = FirebaseJWT::encode($payload, $privateKey, "RS256");
			return print_r($firebaseJwtEncode, true);
        }

		public function getToken() {
			return $this->token;
		}

        public function isValid() {
            return $this->isValid;
		}

	}