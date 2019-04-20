<?php

namespace Edu\emartinez451\objectOrientedProject;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * Cross Section of a Author
 *
 * This is a cross section of what is probably stored about a author. This entity is a top level entity that
 * holds the keys to the other entities in this example (i.e., Favorite and Profile).
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
	 * hash for profile password
	 * @var $authorhash
	**/
	private $authorHash;
	/**
	 * phone number for this Author
	 * @var string $profilePhone
	 **/
	private $authorPhone;
	/**
	 *salt for author password
	 *
	 * @var $authorSalt
	 * /
	private $profileSalt;

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
	 * @throws \RangeException if $newAuthorId value of new author id

	 */
}