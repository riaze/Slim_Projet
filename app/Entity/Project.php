<?php
namespace App\Entity;

use Generic\Entity\EntityInterface;

class Project implements  EntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $url;

    /**
     * @var bool
     */
    private $isPublished;

    /**
     * @var \DateTime
     */
    private $publishedAt;

    /**
     * @var \DateTime
     */
    private $programmedAt;

    /**
     * @param array $params
     * @return Project
     */
    static public function getInstanceFromPost(array $params): Project
    {
        return new Project(
            $params['nom'],
            $params['description'],
            $params['image'],
            $params['url'],
            isset($params['is-published']),
            new \DateTime($params['programmed-at'])
        );
    }
    public function __construct(
        ?string $nom=null,
        ?string $description=null,
        ?string $image=null,
        ?string $url=null,
        ?bool $isPublished=null,
        ?\Datetime $programmedAt=null
    ) {
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->isPublished = $isPublished;
        $this->programmedAt = $programmedAt;
        $this->publishedAt = new \DateTime("now");

        // todo : initialiser le slug par rapport au nom
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @return \DateTime
     */
    public function getProgrammedAt(): \DateTime
    {
        return $this->programmedAt;
    }

    /**
     * Return un tableau correspondent aus colonnees
     * @return array
     */
    public function getArrayForDatabase(): array
    {
        return [

            "nom" =>$this->getNom(),

             "slug"=>$this->getSlug(),
             "description"=>$this->getDescription(),
            "image" =>$this->getImage(),
            "published_at"=>$this->getPublishedAt()->format('Y-m-d H:i:s'),
            "prgrammed_at"=>$this->getPublishedAt()->format('Y-m-d H:i:s'),
            "url"=>$this->getUrl(),
            "isPublished"=>$this->isPublished()



        ];


    }
}