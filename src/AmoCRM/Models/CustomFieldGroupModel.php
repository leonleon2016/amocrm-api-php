<?php

namespace AmoCRM\Models;

use InvalidArgumentException;

class CustomFieldGroupModel extends BaseApiModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $isPredefined;

    /**
     * @var int
     */
    protected $sort;

    /**
     * @var int
     */
    protected $requestId;

    /**
     * @param array $customFieldGroup
     *
     * @return self
     */
    public static function fromArray(array $customFieldGroup): self
    {
        if (empty($customFieldGroup['id'])) {
            throw new InvalidArgumentException('Custom field group id is empty in ' . json_encode($customFieldGroup));
        }

        $customFieldGroupModel = new self();

        $customFieldGroupModel
            ->setId($customFieldGroup['id'])
            ->setName($customFieldGroup['name'])
            ->setSort($customFieldGroup['sort'])
            ->setIsPredefined($customFieldGroup['is_predefined']);

        return $customFieldGroupModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $result = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'sort' => $this->getSort(),
            'is_predefined' => $this->getIsPredefined(),
        ];

        return $result;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return CustomFieldGroupModel
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CustomFieldGroupModel
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     * @return CustomFieldGroupModel
     */
    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPredefined(): bool
    {
        return $this->isPredefined;
    }

    /**
     * @param bool $flag
     * @return CustomFieldGroupModel
     */
    public function setIsPredefined(bool $flag): self
    {
        $this->isPredefined = $flag;

        return $this;
    }

    /**
     * @param int|null $requestId
     * @return array
     */
    public function toApi(int $requestId = null): array
    {
        $result = [];

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getSort())) {
            $result['sort'] = $this->getSort();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId + 1); //Бага в API не принимает 0
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }


    /**
     * @return int|null
     */
    public function getRequestId(): ?int
    {
        return $this->requestId;
    }

    /**
     * @param int|null $requestId
     * @return CustomFieldGroupModel
     */
    public function setRequestId(?int $requestId): self
    {
        $this->requestId = $requestId;

        return $this;
    }
}