<?php
namespace App\Tests\Builder;

use App\Builder\ProgramBuilderService;
use App\Entity\BuilderEntity;
use App\Entity\BuilderField;
use App\Entity\BuilderModule;
use App\Repository\BuilderEntityRepository;
use App\Repository\BuilderModuleRepository;
use App\Runtime\PermissionResolver;
use App\Runtime\RuntimeHttpException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DecimalFilterGenerationTest extends TestCase
{
    private function service(): ProgramBuilderService
    {
        $entity = (new BuilderEntity())->setCode('consultas')->setName('Consultas')->setEntityType('api')
            ->setMetadata(['apiSource' => ['listEndpoint' => ['url' => '/records'], 'detailEndpoint' => ['url' => '/record']]]);
        foreach (['decimal','integer','boolean','string','date','datetime','enum'] as $offset=>$type) {
            $index=$offset+1;
            $entity->addField((new BuilderField())->setCode('field_' . $index)->setLabel('Campo ' . $index)
                ->setDataType($type)->setPrimaryKey($index === 2)->setOptions([
                    'readonly' => true, 'writable' => false, 'api' => ['showInGrid' => true, 'showInFilter' => true],
                ]));
        }
        $entity->addField((new BuilderField())->setCode('json_data')->setLabel('JSON')->setDataType('json'));
        $modules = $this->createStub(BuilderModuleRepository::class);
        $modules->method('findOneBy')->willReturn((new BuilderModule())->setCode('operacional')->setName('Operacional')
            ->setAbbreviation('op')->setNumberStart(1000)->setNumberEnd(1999));
        $entities = $this->createStub(BuilderEntityRepository::class);
        $entities->method('findOneBy')->willReturn($entity);
        $permissions = $this->createStub(PermissionResolver::class);
        $permissions->method('hasPermission')->willReturn(true);
        $overrides = [BuilderModuleRepository::class => $modules, BuilderEntityRepository::class => $entities, PermissionResolver::class => $permissions];
        $reflection = new \ReflectionClass(ProgramBuilderService::class);
        $args = [];
        foreach ($reflection->getConstructor()->getParameters() as $parameter) {
            $type = $parameter->getType()->getName();
            $args[] = $overrides[$type] ?? $this->createStub($type);
        }
        return $reflection->newInstanceArgs($args);
    }


    private function definition(bool $explicit): array
    {
        $payload=['programCode'=>'op1000','programTitle'=>'Consulta','subtitle'=>'Regressao de filtros numericos','module'=>'operacional','screenId'=>'ciw.consultas','builderEntityCode'=>'consultas','allowCreate'=>false,'allowUpdate'=>false,'allowDelete'=>false];
        if($explicit)$payload['crudOptions']=['filterFields'=>['field_1','field_2','field_3','field_4','field_5','field_6','field_7']];
        $definition=$this->service()->saveDraft($payload)['generatedDefinition'];
        $name=$explicit?'explicit':'default';
        file_put_contents('D:/opencode/conversao-sc/.runtime/ciw-completion-20261028/builder-decimal-filters-v2/'.getenv('CIW_DECIMAL_MODE').'-'.$name.'.json',json_encode($definition,JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR));
        return $definition;
    }
    public function testDefaultDecimalFilterUsesNumericTypeAndEquality(): void
    {
        $d=$this->definition(false);$f=$d['crud']['filter']['fields'];
        self::assertSame('decimal',$f[0]['type']);self::assertSame('eq',$f[0]['operator']);
        self::assertSame('integer',$f[1]['type']);self::assertSame('eq',$f[1]['operator']);
        self::assertSame('boolean',$f[2]['type']);self::assertSame('eq',$f[2]['operator']);
        self::assertSame('date',$f[3]['type']);self::assertSame('contains',$f[3]['operator']);
        self::assertSame('datetime',$f[4]['type']);self::assertSame('contains',$f[4]['operator']);
        self::assertCount(5,$f);
    }
    public function testExplicitDecimalFilterUsesNumericTypeAndEquality(): void
    {
        $d=$this->definition(true);$f=$d['crud']['filter']['fields'];
        self::assertSame('decimal',$f[0]['type']);self::assertSame('eq',$f[0]['operator']);
        foreach([1=>'integer',2=>'boolean',4=>'date',5=>'datetime',6=>'enum']as$i=>$type){self::assertSame($type,$f[$i]['type']);self::assertSame('eq',$f[$i]['operator']);}
        self::assertSame('text',$f[3]['type']);self::assertSame('contains',$f[3]['operator']);
        self::assertCount(7,$f);
    }
}
