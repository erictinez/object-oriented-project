<?php

namespace Edu\emartinez451\objectOrientedProject;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * Cross Section of a Author
 *
 * This is a cross section of what is probably stored about a author. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and Author).
 *
 * @author Eric martinez <emartinez451@cnm.eduu>
 * @version 1.0.0
 **/
class Author {
	use ValidateUuid;
	/**
	 * id for this Author: this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * at handle for this Author; this is a unique index
	 * @var string $authorHandle
	 **/
	private $authorActivationToken;
	/**
	 * email for this Author; this is a unique index
	 * @var string $authorEmail
	 **/
	private $authorEmail;
	/**
	 * hash for author password
	 * @var $authorhash
	**/
	private $authorHash;
	/**
	 * phone number for this Author
	 * @var string $authorPhone
	 **/
	private $authorPhone;
	/**
	 *salt for author password
	 *
	 * @var $authorSalt
	 */
	private $authorSalt;

	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id (or null if new Author)
	 **/
	public function getAuthorId(): Uuid {
			  return ($this->authorId);
	}
	/**
	 * mutator method for author id
	 *
	 * @param Uuid| string $newAuthorId value of new author id
	 * @throws \RangeException if $newAuthorId value is not positive
	 * @throws /TypeError if the author id is not
	 **/
	public function setAuthorId( $newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the author id
		$this->authorId = $uuid;
	}

		/**
		 * accessor method for account activation token
		 *
		 * @return string value of the activation token
		 *
		 */
		public function getAuthorActivationToken() : ?string {
				  return ($this->authorActivationToken);
		}
		/**
		 * mutator method for account activation token
		 *
		 *@param string $newAuthorActivationToken
		 *@throws \InvalidArgumentException if the token is not a string or insecure
		 *@throws \RangeException if the token is not exactly n32 characters
		 *@throws \TypeError if the activation token is not a string
		 */
		public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
			if($newAuthorActivationToken === null) {
				$this->authorActivationToken = null;
				return;
			}
			$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
			if(ctype_xdigit($newAuthorActivationToken) === false) {
				throw(new\RangeException("user activation is not valid"));
			}
			//make sure user activation token is only 32 characters
			if(strlen($newAuthorActivationToken) !== 32) {
				throw(new\RangeException("user activation token has to be 32"));
			}
			$this->authorActivationToken = $newAuthorActivationToken;
		}
	/**
	 * accessor method for at handle
	 *
	 * @return string value of at handle
	 **/
	public function getAuthorAtHandle(): string {
		return ($this->authorAtHandle);
	}
	/**
	 * mutator method for at handle
	 *
	 * @param string $newAuthorAtHandle new value of at handle
	 * @throws \InvalidArgumentException if $newAtHandle is not a string or insecure
	 * @throws \RangeException if $newAtHandle is > 32 characters
	 * @throws \TypeError if $newAtHandle is not a string
	 **/
	public function setAuthorAtHandle(string $newAuthorAtHandle) : void {
		// verify the at handle is secure
		$newAuthorAtHandle = trim($newAuthorAtHandle);
		$newAuthorAtHandle = filter_var($newAuthorAtHandle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorAtHandle) === true) {
			throw(new \InvalidArgumentException("author at handle is empty or insecure"));
		}
		// verify the at handle will fit in the database
		if(strlen($newAuthorAtHandle) > 32) {
			throw(new \RangeException("author at handle is too large"));
		}
		// store the at handle
		$this->authorAtHandle = $newAuthorAtHandle;
	}
	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getAuthorEmail(): string {
		return $this->aurthorEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newAuthorEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setAuthorEmail(string $newAuthorEmail): void {
		// verify the email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("author email is too large"));
		}
		// store the email
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accessor method for authorHash
	 *
	 * @return string value of hash
	 */
	public function getAuthorHash(): string {
		return $this->authorHash;
	}

	/**
	 * mutator method for author hash password
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if author hash is not a string
	 */
	public function setAuthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$authorHashInfo = password_get_info($newAuthorHash);
		if($authorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("author hash must be 97 characters"));
		}
		//store the hash
		$this->authorHash = $newAuthorHash;
	}
	/**
	 * accessor method for phone
	 *
	 * @return string value of phone or null
	 **/
	public function getAuthorPhone(): ?string {
		return ($this->authorPhone);
	}
	/**
	 * mutator method for phone
	 *
	 * @param string $newAuthorPhone new value of phone
	 * @throws \InvalidArgumentException if $newPhone is not a string or insecure
	 * @throws \RangeException if $newPhone is > 32 characters
	 * @throws \TypeError if $newPhone is not a string
	 **/
	public function setAuthorPhone(?string $newAuthorPhone): void {
		//if $authorPhone is null return it right away
		if($newAuthorPhone === null) {
			$this->authorPhone = null;
			return;
		}
		// verify the phone is secure
		$newAuthorPhone = trim($newAuthorPhone);
		$newAuthorPhone = filter_var($newAuthorPhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorPhone) === true) {
			throw(new \InvalidArgumentException("author phone is empty or insecure"));
		}
		// verify the phone will fit in the database
		if(strlen($newAuthorPhone) > 32) {
			throw(new \RangeException("author phone is too large"));
		}
		// store the phone
		$this->authorPhone = $newAuthorPhone;
	}
}
