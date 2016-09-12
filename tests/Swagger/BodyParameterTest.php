<?php

class BodyParameterTest extends PHPUnit_Framework_TestCase
{

	protected $parent;

	protected function setUp()
	{
		$this->parent = $this->getMockForAbstractClass('\SwaggerGen\Swagger\AbstractObject');
	}

	protected function assertPreConditions()
	{
		$this->assertInstanceOf('\SwaggerGen\Swagger\AbstractObject', $this->parent);
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorNoType()
	{
		$this->setExpectedException('\SwaggerGen\Exception', "No type definition for body parameter");
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, '');
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorNoName()
	{
		$this->setExpectedException('\SwaggerGen\Exception', "No name for body parameter");
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'wrong');
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorType()
	{
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'int foo');
		$this->assertInstanceOf('\SwaggerGen\Swagger\BodyParameter', $object);

		$this->assertSame(array(
			'name' => 'foo',
			'in' => 'body',
			'schema' => array(
				'type' => 'integer',
				'format' => 'int32',
			),
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorReference()
	{
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'User foo');
		$this->assertInstanceOf('\SwaggerGen\Swagger\BodyParameter', $object);

		$this->assertSame(array(
			'name' => 'foo',
			'in' => 'body',
			'schema' => array(
				'$ref' => '#/definitions/User',
			),
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorDescription()
	{
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'int foo Some more words');
		$this->assertInstanceOf('\SwaggerGen\Swagger\BodyParameter', $object);

		$this->assertSame(array(
			'name' => 'foo',
			'in' => 'body',
			'description' => 'Some more words',
			'schema' => array(
				'type' => 'integer',
				'format' => 'int32',
			),
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorRequired()
	{
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'int foo', true);
		$this->assertInstanceOf('\SwaggerGen\Swagger\BodyParameter', $object);

		$this->assertSame(array(
			'name' => 'foo',
			'in' => 'body',
			'required' => true,
			'schema' => array(
				'type' => 'integer',
				'format' => 'int32',
			),
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\BodyParameter::__construct
	 */
	public function testConstructorNotRequired()
	{
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'int foo', false);
		$this->assertInstanceOf('\SwaggerGen\Swagger\BodyParameter', $object);

		$this->assertSame(array(
			'name' => 'foo',
			'in' => 'body',
			'schema' => array(
				'type' => 'integer',
				'format' => 'int32',
			),
				), $object->toArray());
	}

	/**
	 * @covers \SwaggerGen\Swagger\Type\BodyParameter->handleCommand
	 */
	public function testCommandPassing()
	{
		$object = new \SwaggerGen\Swagger\BodyParameter($this->parent, 'int foo', false);
		$this->assertInstanceOf('\SwaggerGen\Swagger\BodyParameter', $object);

		$object->handleCommand('default', '123');

		$this->assertSame(array(
			'name' => 'foo',
			'in' => 'body',
			'schema' => array(
				'type' => 'integer',
				'format' => 'int32',
				'default' => 123,
			),
				), $object->toArray());
	}

}
